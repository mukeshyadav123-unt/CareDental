import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss'],
})
export class NavbarComponent implements OnInit {
  currentUser: any = null;
  constructor(private authService: AuthService) {
    this.authService.userSubject.subscribe((user) => {
      this.currentUser = user;
    });
  }

  ngOnInit(): void {}
  logoutClicked() {
    this.authService.logout();
  }
}
