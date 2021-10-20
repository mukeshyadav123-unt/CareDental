import {
  ChatAdapter,
  ChatParticipantStatus,
  ChatParticipantType,
  IChatParticipant,
  Message,
  MessageType,
  ParticipantResponse,
} from 'ng-chat';
import { Observable, of } from 'rxjs';
import { map } from 'rxjs/operators';
import { AuthService } from 'src/app/services/auth.service';
import { ChatService } from 'src/app/services/chat.service';

export class AllChatAdapter extends ChatAdapter {
  public userId!: string;
  public contactsList: any = [];

  constructor(
    private chatService: ChatService,
    private authService: AuthService
  ) {
    super();
  }

  listFriends(): any {
    return this.chatService.getContacts().pipe(
      map((res: any) => [
        ...(res?.data?.patient || []),
        ...(res?.data?.doctor || []),
        ...(res?.data?.admin || []),
      ]),
      map((list: any) => {
        this.contactsList = list;
        return list?.map((user: any) => {
          let participantResponse = new ParticipantResponse();

          user = {
            ...user,
            participantType: ChatParticipantType.User,
            displayName: user?.name,
            avatar: 'assets/images/user-chat.png',
            status: ChatParticipantStatus.Away,
          };

          participantResponse.participant = user;
          return participantResponse;
        });
      })
    );
  }

  getMessageHistory(destinationId: any): Observable<Message[]> {
    const selectedContact = this.contactsList?.find((c: any) => {
      return c?.id === destinationId;
    });

    if (selectedContact?.chat_id)
      return this.chatService.getHistory(selectedContact?.chat_id).pipe(
        map((res: any) => res?.data),
        map((msgData: any) => {
          return msgData?.messages?.map((msg: any) => {
            msg = {
              fromId: MessageType.Text,
              toId: msgData?.doctor_id || msgData?.patient_id,
              message: msg?.message,
              //   dateSent: msg?.created_at,
            };

            return msg;
          });
        })
      );
    else return of([]);
  }

  sendMessage(message: Message): void {
    this.chatService
      .sendMessage(message, message?.toId)
      .subscribe((res: any) => {
        console.log(res);
      });
  }
}
