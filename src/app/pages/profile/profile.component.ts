import { Component, OnInit } from '@angular/core';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { UserService } from 'src/app/services/user.service';

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
    gender: 'male',
    current_password: '',
    new_password: '',
    new_password_confirmation: '',
  };
  constructor(
    private userService: UserService,
    private customToastrService: CustomToastrService
  ) {}

  ngOnInit(): void {
    this.getProfile();
  }
  getProfile() {
    this.userService.getMe().subscribe((res: any) => {
      this.profile = res;
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
    this.userService.updateProfile(updatedUser).subscribe(
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
