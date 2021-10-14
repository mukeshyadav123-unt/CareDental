import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class TimesService {
  constructor(private httpClient: HttpClient) {}

  getTimes() {
    return this.httpClient.get(`${environment.api}/api/doctor-routes/times`);
  }
  addTime(time: any) {
    return this.httpClient.post(
      `${environment.api}/api/doctor-routes/times`,
      time
    );
  }
  deleteTime(id: any) {
    return this.httpClient.delete(
      `${environment.api}/api/doctor-routes/times/${id}`
    );
  }
}
