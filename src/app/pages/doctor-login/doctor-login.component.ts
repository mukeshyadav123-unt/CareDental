import { Component, OnInit } from '@angular/core';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { DoctorService } from 'src/app/services/doctor.service';

@Component({
  selector: 'app-login',
  templateUrl: './doctor-login.component.html',
  styleUrls: ['./doctor-login.component.scss'],
})
export class DoctorLoginComponent implements OnInit {
  user = {
    email: '',
    password: '',
  };
  constructor(
    private doctorService: DoctorService,
    private customToastrService: CustomToastrService
  ) {}

  ngOnInit(): void {}

  login() {
    this.doctorService.login(this.user).subscribe(
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
