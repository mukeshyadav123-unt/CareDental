import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class ChatService {
  constructor(private httpClient: HttpClient) {}

  getContacts() {
    return this.httpClient.get(`${environment.api}/api/chat/contact-list`);
  }

  getHistory(id: any) {
    return this.httpClient.get(`${environment.api}/api/chat/${id}`);
  }

  sendMessage(message: any, id: any) {
    return this.httpClient.post(`${environment.api}/api/chat`, {
      receiver_id: id,
      message: message?.message,
    });
  }
}
