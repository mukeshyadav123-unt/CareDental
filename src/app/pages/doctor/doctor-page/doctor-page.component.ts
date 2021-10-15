import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { DoctorsService } from 'src/app/services/doctors/doctors.service';
import { VisitsService } from 'src/app/services/doctors/visits.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-doctor-page',
  templateUrl: './doctor-page.component.html',
  styleUrls: ['./doctor-page.component.scss'],
})
export class DoctorPageComponent implements OnInit {
  doctorId = '';
  doctorData: any = null;
  constructor(
    private DoctorsService: DoctorsService,
    private visitsService: VisitsService,
    private customToastrService: CustomToastrService,
    private route: ActivatedRoute
  ) {
    this.route.params.subscribe((params) => (this.doctorId = params.id));
  }

  getDoctor() {
    this.DoctorsService.getDoctor(this.doctorId).subscribe((res: any) => {
      this.doctorData = res?.data;
    });
  }

  ngOnInit(): void {
    this.getDoctor();
  }

  reserve(time: any) {
    Swal.fire({
      title: 'Notes',
      input: 'text',
      inputAttributes: {
        autocapitalize: 'off',
      },
      showCancelButton: true,
      confirmButtonText: 'Submit',
      showLoaderOnConfirm: true,
    }).then((result) => {
      if (result.isConfirmed) {
        this.visitsService
          .createVisit({ doctor_time_id: time.id, notes: result?.value })
          .subscribe(
            (res: any) => {
              this.customToastrService.showToast('Reservation Added', 'Added');
              this.getDoctor();
            },
            (err) => {
              this.getDoctor();
              this.customToastrService.showErrorToast(
                "Couldn't Add Reservation",
                'Failed'
              );
            }
          );
      }
    });
  }
}
