import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { CookieService } from 'ngx-cookie-service';
import { AuthService } from 'src/app/services/auth.service';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';

@Component({
  selector: 'app-forgot-password',
  templateUrl: './forgot-password.component.html',
  styleUrls: ['./forgot-password.component.scss'],
})
export class ForgotPasswordComponent implements OnInit {
  passwordReset = {
    email: '',
    new_password: '',
    code: '',
  };

  showReset = false;

  constructor(
    private authService: AuthService,
    private customToastrService: CustomToastrService,
    private cookieService: CookieService,
    private router: Router
  ) {}

  ngOnInit(): void {
    if (
      this.cookieService.check('Token') &&
      this.authService.userSubject.getValue()?.role
    ) {
      this.router.navigate(['/']);
    }
  }

  forgotPassword() {
    this.authService.forgotPassword(this.passwordReset.email).subscribe(
      (res) => {
        this.showReset = true;
        this.customToastrService.showToast(
          'Code was sent to your email',
          'Success'
        );
      },
      (err) => {
        const errMsg = err.error?.message
          ? err.error.message
          : "Couldn't send code";
        this.customToastrService.showErrorToast(errMsg, 'Failed');

        this.showReset = false;
      }
    );
  }
  resetPassword() {
    this.authService.resetPassword({ ...this.passwordReset }).subscribe(
      (res) => {
        this.router.navigate(['/user-login']);

        this.customToastrService.showToast(
          'Password Reset Successfully',
          'Success'
        );
      },
      (err) => {
        const errMsg = err.error?.message
          ? err.error.message
          : "Couldn't reset password";
        this.customToastrService.showErrorToast(errMsg, 'Failed');

        //change this
      }
    );
  }
}
