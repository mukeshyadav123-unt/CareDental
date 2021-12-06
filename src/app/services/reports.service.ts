import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class PatientReportsService {
  constructor(private httpClient: HttpClient) {}

  getMyReports(page = 1) {
    return this.httpClient.get(`${environment.api}/api/patient/reports`, {
      params: {
        page: page.toString(),
      },
    });
  }
}
