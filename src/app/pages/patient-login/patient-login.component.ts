import { Component, OnInit } from '@angular/core';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { UserService } from 'src/app/services/user.service';

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
    private userService: UserService,
    private customToastrService: CustomToastrService
  ) {}

  ngOnInit(): void {}

  login() {
    this.userService.login(this.user).subscribe(
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
