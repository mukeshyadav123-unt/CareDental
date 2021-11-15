import { Component, OnInit } from '@angular/core';
import { OwlOptions } from 'ngx-owl-carousel-o';

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
  slides: Slide[] = [
    {
      image: '../../assets/images/successful-medical-team (1).jpg',
      text: 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum',
    },
    {
      image:
        '../../assets/images/curly-woman-cares-about-teeth-holds-dental-floss-surrounded-by-toothpaste-brushes.jpg',
      text: 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum',
    },
    {
      image: '../../assets/images/patient-login.jpg',
      text: 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum',
    },
  ];

  steps: Slide[] = [
    {
      image: '../../assets/images/iconfinder_3_3319636.png',
      text: 'Appointments',
      url: '/visits',
    },
    {
      image:
        '../../assets/images/iconfinder_sale_lineal_color_cnvrt-18_3827704.png',
      text: 'Contact Us',
      url: '/contact-us',
    },
    {
      image: '../../assets/images/house-pngrepo-com.png',
      text: 'is simply dummy text of the printing and typesetting industry. Lorem Ipsum',
      url: 'user',
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
  constructor() {}

  ngOnInit(): void {}
}
