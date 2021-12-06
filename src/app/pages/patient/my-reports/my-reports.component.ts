import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { PatientReportsService } from 'src/app/services/reports.service';

@Component({
  selector: 'app-my-reports',
  templateUrl: './my-reports.component.html',
  styleUrls: ['../../staff/all-patients/all-patients.component.scss'],
})
export class MyReportsComponent implements OnInit {
  reports: any = [];
  pageData: any = null;
  constructor(
    private reportsService: PatientReportsService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.getReports();
  }

  getReports(page = 1) {
    this.reportsService.getMyReports(page).subscribe((res: any) => {
      this.reports = res?.data;
      this.pageData = res?.meta;
    });
  }

  onSearchChange(event: any) {
    this.getReports(1);
  }

  changePage(page: number = 1) {
    this.getReports(page);
  }

  showDoctor(doctor: any) {
    this.router.navigate(['doctor', doctor.id]);
  }
}
