import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class StaffService {
  constructor(private httpClient: HttpClient) {}

  getPatients(page = 1) {
    return this.httpClient.get(`${environment.api}/api/staff/patients`, {
      params: {
        page: page.toString(),
      },
    });
  }

  getReports(page = 1) {
    return this.httpClient.get(`${environment.api}/api/staff/reports`, {
      params: {
        page: page.toString(),
      },
    });
  }

  getDoctors(page = 1) {
    return this.httpClient.get(`${environment.api}/api/staff/doctors`, {
      params: {
        page: page.toString(),
      },
    });
  }

  getVisits(page = 1) {
    return this.httpClient.get(`${environment.api}/api/staff/visits`, {
      params: {
        page: page.toString(),
      },
    });
  }
}
