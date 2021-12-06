import { Component, OnInit } from '@angular/core';
import { OwlOptions } from 'ngx-owl-carousel-o';
import { AuthService } from 'src/app/services/auth.service';

interface Slide {
  image: string;
  text: string;
  url?: string;
}
@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss'],
})
export class HomeComponent implements OnInit {
  currentUser: any = null;

  slides: Slide[] = [
    {
      image: '../../assets/images/successful-medical-team (1).jpg',
      text: '“Specialty care. we don’t compromise on the quality of care.” <br/> -CARE DENTAL HOME',
    },
    {
      image:
        '../../assets/images/curly-woman-cares-about-teeth-holds-dental-floss-surrounded-by-toothpaste-brushes.jpg',
      text: '“Specialty care. we don’t compromise on the quality of care.” <br/> -CARE DENTAL HOME',
    },
    {
      image: '../../assets/images/patient-login.jpg',
      text: '“Specialty care. we don’t compromise on the quality of care.” <br/> -CARE DENTAL HOME',
    },
  ];

  steps: Slide[] = [
    {
      image: '../../assets/images/iconfinder_3_3319636.png',
      text: 'Appointments',
      url: '',
    },
    {
      image:
        '../../assets/images/iconfinder_sale_lineal_color_cnvrt-18_3827704.png',
      text: 'Contact Us',
      url: '/contact-us',
    },
    {
      image: '../../assets/images/house-pngrepo-com.png',
      text: 'Facilities',
      url: '/facilities',
    },
  ];

  customOptions: OwlOptions = {
    loop: true,
    mouseDrag: true,
    touchDrag: true,
    pullDrag: false,
    dots: false,
    navSpeed: 700,
    margin: 10,
    navText: ['Prev', 'Next'],
    autoplay: true,
    autoplayTimeout: 5000,
    responsive: {
      0: {
        items: 1,
      },
      500: {
        items: 1,
      },
      720: {
        items: 2,
      },
      1020: {
        items: 3,
      },
    },
    nav: false,
  };

  constructor(private authService: AuthService) {
    this.authService.userSubject.subscribe((user) => {
      this.currentUser = user;
      this.steps[0].url =
        this.currentUser?.role == 'doctor'
          ? '/visits'
          : this.currentUser?.role == 'admin'
          ? '/admin/visits'
          : '/reservations';
    });
  }
  ngOnInit(): void {}
}
