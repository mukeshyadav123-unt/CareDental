import {
  ChatAdapter,
  ChatParticipantStatus,
  ChatParticipantType,
  IChatParticipant,
  Message,
  MessageType,
  ParticipantResponse,
} from 'ng-chat';
import { Observable, of, interval, Subject, BehaviorSubject } from 'rxjs';
import { map, tap } from 'rxjs/operators';
import { AuthService } from 'src/app/services/auth.service';
import { ChatService } from 'src/app/services/chat.service';

export class AllChatAdapter extends ChatAdapter {
  public userId!: string;
  public interval: any;
  public contactsList: any = [];

  constructor(
    private chatService: ChatService,
    private authService: AuthService
  ) {
    super();
    this.authService.userSubject.subscribe((user) => {
      this.userId = user?.id;
    });
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

          participantResponse.metadata = {
            totalUnreadMessages: user?.unread_messages_count || 0,
          };
          return participantResponse;
        });
      })
    );
  }

  onParticipantChatClosed(participant: IChatParticipant) {
    this.interval?.clear();
  }

  getMessageHistory(destinationId: any): Observable<Message[]> {
    const selectedContact = this.contactsList?.find((c: any) => {
      return c?.id === destinationId;
    });

    var subject = new BehaviorSubject<Message[]>([]);
    if (selectedContact?.chat_id) {
      this.interval = setInterval(() => {
        subject.next([]);
        this.getAllMessages(selectedContact, subject);
      }, 5000);
      this.getAllMessages(selectedContact, subject);

      return subject.asObservable();
    } else return of([]);
  }

  getAllMessages(selectedContact: any, subject: any) {
    this.chatService
      .getHistory(selectedContact?.chat_id)
      .pipe(
        map((res: any) => res?.data),
        tap((msgData: any) => {
          subject.next(
            msgData?.messages?.map((msg: any) => {
              msg = {
                fromId: msg?.from_you ? this.userId : msgData?.other_sender?.id,

                toId: msg?.from_you ? msgData?.other_sender?.id : this.userId,

                message: msg?.message,
                //   dateSent: msg?.created_at,
              };

              return msg;
            })
          );
        })
      )
      .subscribe(() => {});
  }

  sendMessage(message: Message): void {
    this.chatService
      .sendMessage(message, message?.toId)
      .subscribe((res: any) => {
        //console.log(res);
      });
  }
}
