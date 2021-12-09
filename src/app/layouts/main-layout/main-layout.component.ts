import { Component, OnInit } from '@angular/core';
import { AllChatAdapter } from 'src/app/pages/shared/chat/adapter';
import { AuthService } from 'src/app/services/auth.service';
import { ChatService } from 'src/app/services/chat.service';

@Component({
  selector: 'app-main-layout',
  templateUrl: './main-layout.component.html',
  styleUrls: ['./main-layout.component.scss'],
})
export class MainLayoutComponent implements OnInit {
  currentUser: any = null;
  title = 'app';
  userId = 999;

  chatAdapter!: AllChatAdapter;

  constructor(
    private authService: AuthService,
    private chatService: ChatService
  ) {
    this.authService.userSubject.subscribe((user) => {
      this.currentUser = user;
      this.userId = user?.id;
    });
    this.chatAdapter = new AllChatAdapter(this.chatService, this.authService);
  }

  clearRefresh(event: any) {
    clearInterval(this.chatAdapter.interval);
  }

  ngOnInit(): void {}
}
