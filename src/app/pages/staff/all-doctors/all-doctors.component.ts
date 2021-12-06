import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { StaffService } from 'src/app/services/staff.service';

@Component({
  selector: 'app-all-doctors',
  templateUrl: './all-doctors.component.html',
  styleUrls: ['../all-patients/all-patients.component.scss'],
})
export class AllDoctorsComponent implements OnInit {
  doctors: any = [];
  pageData: any = null;
  constructor(private staffService: StaffService, private router: Router) {}

  ngOnInit(): void {
    this.getPatients();
  }

  getPatients(page = 1) {
    this.staffService.getDoctors(page).subscribe((res: any) => {
      this.doctors = res?.data;
      this.pageData = res?.meta;
    });
  }

  onSearchChange(event: any) {
    this.getPatients(1);
  }

  changePage(page: number = 1) {
    this.getPatients(page);
  }

  showDoctor(doctor: any) {
    this.router.navigate(['doctor', doctor.id]);
  }
}
