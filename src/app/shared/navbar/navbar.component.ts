import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss'],
})
export class NavbarComponent implements OnInit {
  currentUser: any = null;
  isInPatientLoginPage: boolean = false;

  constructor(private authService: AuthService, private router: Router) {
    this.authService.userSubject.subscribe((user) => {
      this.currentUser = user;
    });

    router.events.subscribe((val) => {
      this.isInPatientLoginPage =
        window?.location?.href?.includes('user-login');
    });
  }

  ngOnInit(): void {}
  logoutClicked() {
    this.authService.logout();
  }
}
