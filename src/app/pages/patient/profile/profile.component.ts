import { Component, OnInit } from '@angular/core';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss'],
})
export class ProfileComponent implements OnInit {
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
    preferred_first_name: '',
    race: '',
    ethnic_background: '',
    religion: '',
    marital_status: '',
    ethnicity: '',
  };

  contactInformation: any = {
    home_phone_number: '',
    work_phone_number: '',
    address: '',
    temp_address: '',
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
    this.authService.getPatientProfile().subscribe((res: any) => {
      this.profile = res?.data;
      this.details = { ...this.details, ...(res?.data?.details || {}) };
      this.contactInformation = {
        ...this.contactInformation,
        ...(res?.data?.contact_information || {}),
      };
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
    this.authService.updatePatientProfile({ user: updatedUser }).subscribe(
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

  updateDetails() {
    let updatedDetails: any = Object.assign({}, this.details);

    this.authService
      .updatePatientProfile({ details: updatedDetails })
      .subscribe(
        (res: any) => {
          this.customToastrService.showToast('Details Updated', 'Updated');
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
            errMsg || "Couldn't Update Details",
            'Failed'
          );
        }
      );
  }

  updateContacts() {
    let contactInfo: any = Object.assign({}, this.contactInformation);

    this.authService
      .updatePatientProfile({ contact_information: contactInfo })
      .subscribe(
        (res: any) => {
          this.customToastrService.showToast('Contact Info Updated', 'Updated');
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
            errMsg || "Couldn't Update Contact Info",
            'Failed'
          );
        }
      );
  }
}
