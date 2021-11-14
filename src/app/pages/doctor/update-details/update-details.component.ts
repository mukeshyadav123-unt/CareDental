import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { DoctorsService } from 'src/app/services/doctors/doctors.service';

@Component({
  selector: 'app-update-details',
  templateUrl: './update-details.component.html',
  styleUrls: ['./update-details.component.scss'],
})
export class UpdateDetailsComponent implements OnInit {
  @Input() profile: any;
  @Output() refresh: EventEmitter<any> = new EventEmitter();
  constructor(
    private authService: AuthService,
    private doctorsService: DoctorsService,
    private customToastrService: CustomToastrService
  ) {}

  ngOnInit(): void {}

  formatBody(body: any): any {
    return {
      details: {
        specialty: body?.specialty,
        address: body?.address,
        description: body?.description,
      },
    };
  }

  updateDetails() {
    this.authService
      .updateDoctorProfile(this.formatBody(this.profile))
      .subscribe(
        (res: any) => {
          this.customToastrService.showToast('Details Updated', 'Updated');
          this.refresh.emit(true);
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
}
