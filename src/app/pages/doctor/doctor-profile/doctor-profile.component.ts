import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';

@Component({
  selector: 'app-doctor-profile',
  templateUrl: './doctor-profile.component.html',
  styleUrls: ['./doctor-profile.component.scss'],
})
export class DoctorProfileComponent implements OnInit {
  profile: any = {
    name: '',
    email: '',
    birthday: '',
    phone_number: '',
    current_password: '',
    new_password: '',
    new_password_confirmation: '',
  };

  details: any = {
    specialty: '',
    description: '',
    address: '',
  };

  currentUser: any = null;

  constructor(
    private authService: AuthService,
    private customToastrService: CustomToastrService
  ) {
    this.authService.userSubject.subscribe((user) => {
      this.currentUser = user;
    });
  }

  ngOnInit(): void {
    this.getProfile();
  }

  getProfile() {
    this.authService.getDoctorProfile().subscribe((res: any) => {
      this.profile = res?.data;
      this.details = { ...this.details, ...(res?.data?.details || {}) };
    });
  }

  updateProfile() {
    let updatedUser: any = Object.assign({}, this.profile);
    if (
      this.profile.new_password == '' ||
      this.profile.new_password_confirmation == ''
    ) {
      delete updatedUser.new_password;
      delete updatedUser.new_password_confirmation;
    }
    this.authService.updateDoctorProfile({ user: updatedUser }).subscribe(
      (res: any) => {
        this.customToastrService.showToast('Profile Updated', 'Updated');
        this.getProfile();
      },
      (err) => {
        let errMsg = '';
        if (err?.error?.errors)
          for (const [key, value] of Object.entries(err?.error?.errors)) {
            errMsg = value as any;
            errMsg = errMsg[0];
            break;
          }
        this.customToastrService.showErrorToast(
          errMsg || "Couldn't Update Profile",
          'Failed'
        );
      }
    );
  }
}
