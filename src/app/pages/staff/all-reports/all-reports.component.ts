import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { StaffService } from 'src/app/services/staff.service';

@Component({
  selector: 'app-all-reports',
  templateUrl: './all-reports.component.html',
  styleUrls: ['../all-patients/all-patients.component.scss'],
})
export class AllReportsComponent implements OnInit {
  reports: any = [];
  pageData: any = null;
  constructor(private staffService: StaffService, private router: Router) {}

  ngOnInit(): void {
    this.getReports();
  }

  getReports(page = 1) {
    this.staffService.getReports(page).subscribe((res: any) => {
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
