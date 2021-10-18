import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-main-layout',
  templateUrl: './main-layout.component.html',
  styleUrls: ['./main-layout.component.scss'],
})
export class MainLayoutComponent implements OnInit {
  currentUser: any = null;

  constructor(private authService: AuthService) {
    this.authService.userSubject.subscribe((user) => {
      this.currentUser = user;
    });
  }

  ngOnInit(): void {}
}
