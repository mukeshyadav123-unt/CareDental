import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class ReportsService {
  constructor(private httpClient: HttpClient) {}

  getPatientReports(id: any) {
    return this.httpClient.get(
      `${environment.api}/api/doctor-routes/reports/${id}`
    );
  }

  addReport(body: FormData) {
    return this.httpClient.post(
      `${environment.api}/api/doctor-routes/reports`,
      body,
      {
        reportProgress: true,
        observe: 'events',
      }
    );
  }
}
