import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';

@Component({
  selector: 'app-email-verification',
  templateUrl: './email-verification.component.html',
  styleUrls: ['./email-verification.component.scss'],
})
export class EmailVerificationComponent implements OnInit {
  code: any = '';

  constructor(
    private authService: AuthService,
    private customToastrService: CustomToastrService,
    private router: Router
  ) {}

  ngOnInit(): void {}

  verifyEmail() {
    this.authService.verifyEmail(this.code).subscribe(
      (res: any) => {
        this.customToastrService.showToast('Email Verified', 'Success');
        this.router.navigate(['/']);
      },
      (err) => {
        this.customToastrService.showErrorToast(
          'Something went wrong',
          'Failed'
        );
      }
    );
  }

  resendCode() {
    this.authService.resendCode().subscribe(
      (res: any) => {
        this.customToastrService.showToast('Code Re-sent', 'Success');
      },
      (err) => {
        this.customToastrService.showErrorToast(
          'Something went wrong',
          'Failed'
        );
      }
    );
  }
}
