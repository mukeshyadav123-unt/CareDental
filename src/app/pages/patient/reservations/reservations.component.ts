import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { DoctorsService } from 'src/app/services/doctors/doctors.service';

@Component({
  selector: 'app-reservations',
  templateUrl: './reservations.component.html',
  styleUrls: ['./reservations.component.scss'],
})
export class ReservationsComponent implements OnInit {
  doctors: any = [];
  pageData: any = null;
  constructor(private doctorsService: DoctorsService, private router: Router) {}

  ngOnInit(): void {
    this.getDoctors();
  }

  getDoctors(specialty: string = '', page = 1) {
    this.doctorsService.getDoctors(specialty, page).subscribe((res: any) => {
      this.doctors = res?.data;
      this.pageData = res?.meta;
    });
  }

  onSearchChange(event: any) {
    this.getDoctors(event.target.value, 1);
  }

  changePage(page: number = 1) {
    this.getDoctors('', page);
  }

  showDoctor(doctor: any) {
    this.router.navigate(['doctor', doctor.id]);
  }
}
