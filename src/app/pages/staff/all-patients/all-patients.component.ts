import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { StaffService } from 'src/app/services/staff.service';
@Component({
  selector: 'app-all-patients',
  templateUrl: './all-patients.component.html',
  styleUrls: ['./all-patients.component.scss'],
})
export class AllPatientsComponent implements OnInit {
  patients: any = [];
  pageData: any = null;
  constructor(private staffService: StaffService, private router: Router) {}

  ngOnInit(): void {
    this.getPatients();
  }

  getPatients(page = 1) {
    this.staffService.getPatients(page).subscribe((res: any) => {
      this.patients = res?.data;
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
