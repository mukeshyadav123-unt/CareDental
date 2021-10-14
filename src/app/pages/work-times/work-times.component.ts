import { Component, OnInit } from '@angular/core';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { TimesService } from 'src/app/services/doctors/times.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-work-times',
  templateUrl: './work-times.component.html',
  styleUrls: ['./work-times.component.scss'],
})
export class WorkTimesComponent implements OnInit {
  newTime: any = this.resetTime();
  times: any = [];
  constructor(
    private timesService: TimesService,
    private customToastrService: CustomToastrService
  ) {}

  ngOnInit(): void {
    this.getTimes();
  }

  getTimes() {
    this.timesService.getTimes().subscribe((res: any) => {
      this.times = res?.data;
    });
  }

  resetTime() {
    return (this.newTime = {
      from: '',
      to: '',
      date: '',
    });
  }

  addNewTime() {
    this.timesService.addTime(this.newTime).subscribe(
      (res: any) => {
        this.customToastrService.showToast('New Time Added', 'Added');
        this.getTimes();
        this.resetTime();
      },
      (err) => {
        this.customToastrService.showErrorToast("Couldn't add time", 'Failed');
      }
    );
  }

  deleteTime(time: any) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      showCancelButton: true,
      confirmButtonColor: '#882954',
      cancelButtonColor: '#c5c5c5',
      confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
      if (result.isConfirmed) {
        this.timesService.deleteTime(time.id).subscribe(
          (res) => {
            this.customToastrService.showToast('Time Deleted', 'Deleted');
            this.getTimes();
          },
          (err) => {
            this.customToastrService.showErrorToast(
              "Couldn't delete time",
              'Failed'
            );
          }
        );
      }
    });
  }
}
