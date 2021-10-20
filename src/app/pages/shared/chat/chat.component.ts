import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';
import { ChatService } from 'src/app/services/chat.service';
import { AllChatAdapter } from './adapter';

@Component({
  selector: 'app-chat',
  templateUrl: './chat.component.html',
  styleUrls: ['./chat.component.scss'],
})
export class ChatComponent implements OnInit {
  title = 'app';
  userId = 999;
  currentUser: any = null;

  chatAdapter!: AllChatAdapter;

  constructor(
    private authService: AuthService,
    private chatService: ChatService
  ) {
    this.getUser();
    this.chatAdapter = new AllChatAdapter(this.chatService, this.authService);
  }

  getUser() {
    this.authService.userSubject.subscribe((user) => {
      this.currentUser = user;
    });
  }

  ngOnInit(): void {}
}
