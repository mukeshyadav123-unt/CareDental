import { HttpEventType } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { CustomToastrService } from 'src/app/services/CustomToastr.service';
import { ReportsService } from 'src/app/services/doctors/reports.service';
import { VisitsService } from 'src/app/services/doctors/visits.service';

@Component({
  selector: 'app-doctor-visits',
  templateUrl: './doctor-visits.component.html',
  styleUrls: ['./doctor-visits.component.scss'],
})
export class DoctorVisitsComponent implements OnInit {
  visits: any = [];

  constructor(
    private visitsService: VisitsService,
    private reportsService: ReportsService,
    private customToastrService: CustomToastrService
  ) {}

  ngOnInit(): void {
    this.getVisits();
  }

  getVisits() {
    this.visitsService.getVisits().subscribe((res: any) => {
      res?.data.map((obj: any) => ({
        ...obj,
        loading: false,
        uploading: false,
        progress: 0,
      }));
      this.visits = res?.data;
    });
  }
  toggleDone(evt: any, index: any) {
    this.visits[index].loading = true;
    evt.target.checked || false ? this.markDone(index) : this.markUndone(index);
  }

  markDone(index: any) {
    const selectedVisit = this.visits[index];
    this.visitsService.markVisitDone(selectedVisit.id).subscribe(
      (res) => {
        this.customToastrService.showToast('Marked Done', 'Success');
        this.getVisits();
      },
      (err) => {
        this.customToastrService.showErrorToast("Couldn't mark done", 'Failed');
        this.visits[index].loading = false;
      }
    );
  }

  markUndone(index: any) {
    const selectedVisit = this.visits[index];
    this.visitsService.markVisitUndone(selectedVisit.id).subscribe(
      (res) => {
        this.customToastrService.showToast('Marked Undone', 'Success');
        this.getVisits();
      },
      (err) => {
        this.customToastrService.showErrorToast(
          "Couldn't mark undone",
          'Failed'
        );
        this.visits[index].loading = false;
      }
    );
  }

  uploadReport(event: any, index: any) {
    const formData = new FormData();
    formData.append('patient_id', this.visits[index]?.patient?.id);
    formData.append('report', event.target.files[0]);

    this.visits[index].uploading = true;
    this.reportsService.addReport(formData).subscribe(
      (event) => {
        if (event.type === HttpEventType.UploadProgress) {
          this.visits[index].progress = Math.round(
            (100 * event.loaded) / (event.total || 1)
          );
        }
        if (event.type === HttpEventType.Response) {
          this.customToastrService.showToast('Report Uploaded', 'Success');
          this.visits[index].uploading = false;
        }
      },
      (err) => {
        this.visits[index].uploading = false;

        this.customToastrService.showErrorToast(
          "Couldn't upload Report. File must be a PDF",
          'Failed'
        );
      }
    );
  }

  getAge(dateString: string) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    return age;
  }
}
