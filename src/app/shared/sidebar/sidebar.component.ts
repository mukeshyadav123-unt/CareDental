import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.scss'],
})
export class SidebarComponent implements OnInit {
  currentUser: any = null;
  constructor(private authService: AuthService) {
    this.authService.userSubject.subscribe((user) => {
      this.currentUser = user;
    });
  }

  ngOnInit(): void {}
}
