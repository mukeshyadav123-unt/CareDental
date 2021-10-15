import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class DoctorsService {
  constructor(private httpClient: HttpClient) {}

  getDoctors(specialty: string = '', page = 1) {
    return this.httpClient.get(`${environment.api}/api/doctor`, {
      params: {
        ...(specialty != '' && { specialty }),
        page: page.toString(),
      },
    });
  }

  getDoctor(id: string = '') {
    return this.httpClient.get(`${environment.api}/api/doctor/${id}`, {});
  }
}
