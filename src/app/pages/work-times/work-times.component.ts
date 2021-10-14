import { Component, OnInit } from '@angular/core';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { TimesService } from 'src/app/services/doctors/times.service';

@Component({
  selector: 'app-work-times',
  templateUrl: './work-times.component.html',
  styleUrls: ['./work-times.component.scss'],
})
export class WorkTimesComponent implements OnInit {
  newTime = {
    from: '',
    to: '',
    date: '',
  };
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

  addNewTime() {
    this.timesService.addTime(this.newTime).subscribe(
      (res: any) => {
        this.customToastrService.showToast('New Time Added', 'Added');
        this.getTimes();
      },
      (err) => {
        this.customToastrService.showToast("Couldn't add time", 'Failed');
      }
    );
  }
}
