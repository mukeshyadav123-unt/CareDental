import { Component, OnInit } from '@angular/core';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { UserService } from 'src/app/services/user.service';

@Component({
  selector: 'app-user-sign-up',
  templateUrl: './user-sign-up.component.html',
  styleUrls: ['./user-sign-up.component.scss'],
})
export class UserSignUpComponent implements OnInit {
  user = {
    name: '',
    email: '',
    birthday: '',
    phone_number: '',
    gender: 'male',
    password: '',
    password_confirmation: '',
  };
  constructor(
    private userService: UserService,
    private customToastrService: CustomToastrService
  ) {}

  ngOnInit(): void {}
  register() {
    this.userService.register(this.user).subscribe(
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
