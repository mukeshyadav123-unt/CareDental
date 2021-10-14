import { Component, OnInit } from '@angular/core';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-doctor-sign-up',
  templateUrl: './doctor-sign-up.component.html',
  styleUrls: ['./doctor-sign-up.component.scss'],
})
export class DoctorSignUpComponent implements OnInit {
  user = {
    name: '',
    email: '',
    birthday: '',
    phone_number: '',
    password: '',
    password_confirmation: '',
  };
  constructor(
    private authService: AuthService,
    private customToastrService: CustomToastrService
  ) {}

  ngOnInit(): void {}
  register() {
    this.authService.doctorRegister(this.user).subscribe(
      (res) => {
        this.customToastrService.showToast(
          'Account created successfully',
          'Success'
        );
      },
      (err) => {
        // Object.keys(err)
        // .map((key) => `${err[key]}`)
        // .join(' & ')
        let errMsg = err.error?.message
          ? err.error.message
          : "Couldn't Register";
        this.customToastrService.showErrorToast(errMsg, 'Failed');
      }
    );
  }
}
