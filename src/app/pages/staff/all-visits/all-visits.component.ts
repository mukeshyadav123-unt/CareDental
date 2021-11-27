import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { StaffService } from 'src/app/services/staff.service';

@Component({
  selector: 'app-all-visits',
  templateUrl: './all-visits.component.html',
  styleUrls: ['../all-patients/all-patients.component.scss'],
})
export class AllVisitsComponent implements OnInit {
  visits: any = [];
  pageData: any = null;
  constructor(private staffService: StaffService, private router: Router) {}

  ngOnInit(): void {
    this.getVisits();
  }

  getVisits(page = 1) {
    this.staffService.getVisits(page).subscribe((res: any) => {
      this.visits = res?.data;
      this.pageData = res?.meta;
    });
  }

  onSearchChange(event: any) {
    this.getVisits(1);
  }

  changePage(page: number = 1) {
    this.getVisits(page);
  }

  showDoctor(doctor: any) {
    this.router.navigate(['doctor', doctor.id]);
  }
}
