import { Injectable } from '@angular/core';
import { ToastrService } from 'ngx-toastr';

@Injectable({
  providedIn: 'root',
})
export class CustomToastrService {
  constructor(private toastr: ToastrService) {}

  showErrorToast(msg: string, title: string) {
    this.toastr.error(msg, title, {
      positionClass: 'toast-top-right',
      timeOut: 4000,
    });
  }
  showToast(msg: string, title: string) {
    this.toastr.info(msg, title, {
      positionClass: 'toast-top-right',
      timeOut: 4000,
    });
  }
}
