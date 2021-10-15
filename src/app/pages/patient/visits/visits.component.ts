import { Component, OnInit } from '@angular/core';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { VisitsService } from 'src/app/services/doctors/visits.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-visits',
  templateUrl: './visits.component.html',
  styleUrls: ['./visits.component.scss'],
})
export class VisitsComponent implements OnInit {
  visits: any = [];

  pageData: any = null;
  constructor(
    private visitsService: VisitsService,
    private customToastrService: CustomToastrService
  ) {}

  ngOnInit(): void {
    this.getVisits();
  }

  getVisits(page = 1) {
    this.visitsService.getPatientVisits(page).subscribe((res: any) => {
      this.visits = res?.data;
      this.pageData = res?.meta;
    });
  }

  changePage(page: number = 1) {
    this.getVisits(page);
  }

  reviewDoctor(visit: any) {
    Swal.fire({
      title: 'Add Review ',
      html:
        '<input  id="swal-input1" class="swal2-input" placeholder="Comment">' +
        '<input id="swal-input2" class="swal2-input" placeholder="Rate"> ',
      focusConfirm: false,
      preConfirm: () => {
        return {
          comment: (<HTMLInputElement>document.getElementById('swal-input1'))
            ?.value,
          rate: (<HTMLInputElement>document.getElementById('swal-input2'))
            ?.value,
        };
      },
    }).then((result) => {
      if (result.isConfirmed)
        this.visitsService.reviewVisits(result?.value, visit.id).subscribe(
          (res) => {
            this.customToastrService.showToast('Visit Reviewed', 'Success');
            this.getVisits();
          },
          (err) => {
            this.customToastrService.showErrorToast(
              "Couldn't review visit",
              'Failed'
            );
          }
        );
    });
  }

  cancelVisit(visit: any) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      showCancelButton: true,
      confirmButtonColor: '#882954',
      cancelButtonColor: '#c5c5c5',
      confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
      if (result.isConfirmed) {
        this.visitsService.cancelVisit(visit.id).subscribe(
          (res) => {
            this.customToastrService.showToast('Visit Cancelled', 'Cancelled');
            this.getVisits();
          },
          (err) => {
            this.customToastrService.showErrorToast(
              "Couldn't cancel visit",
              'Failed'
            );
          }
        );
      }
    });
  }
}
