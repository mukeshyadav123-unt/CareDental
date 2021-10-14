import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class VisitsService {
  constructor(private httpClient: HttpClient) {}

  getVisits() {
    return this.httpClient.get(`${environment.api}/api/doctor-routes/visit`);
  }
  markVisitDone(id: string | number) {
    return this.httpClient.put(
      `${environment.api}/api/doctor-routes/visit/${id}/done`,
      {}
    );
  }
  markVisitUndone(id: string | number) {
    return this.httpClient.put(
      `${environment.api}/api/doctor-routes/visit/${id}/not-done`,
      {}
    );
  }
}
