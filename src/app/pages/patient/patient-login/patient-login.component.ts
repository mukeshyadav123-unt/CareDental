import { Component, OnInit } from '@angular/core';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { AuthService } from 'src/app/services/auth.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-patient-login',
  templateUrl: './patient-login.component.html',
  styleUrls: ['./patient-login.component.scss'],
})
export class PatientLoginComponent implements OnInit {
  user = {
    email: '',
    password: '',
  };
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

  login() {
    this.authService.userLogin(this.user).subscribe(
      (res) => {},
      (err) => {
        // Object.keys(err)
        // .map((key) => `${err[key]}`)
        // .join(' & ')
        let errMsg = err.error?.message ? err.error.message : "Couldn't login";
        this.customToastrService.showErrorToast(errMsg, 'Failed');
      }
    );
  }
}
