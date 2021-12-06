import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-our-staff',
  templateUrl: './our-staff.component.html',
  styleUrls: ['./our-staff.component.scss'],
})
export class OurStaffComponent implements OnInit {
  staff: any = [
    {
      name: 'Dr. Gunjan Kumar Shrestha',
      email: ' gunjan_sh361@hotmail.com ',
      profession: ' Consultant Orthodontist ',
      description:
        'Dr. Shrestha is one of the outstanding orthodontists in Nepal. He did his BDS from BPKIHS Dharan in 2011 and Master in Orthodontist from the same institute. He also worked as Lecturer in M. B. Kedia dental college. He is currently working as Registrar in Kirtipur hospital (Nepal Cleft and Burn Center). He is the only Orthodontist in Nepal working in the complex field of Cleft Lip and Palate. He is one of the qualified and competent Orthodontists in Nepal. He has 6 published articles in various journals.',
      img: '../../../assets/images/1622963977.jpg',
    },
    {
      name: 'Dr. Sanjay Ranjit',
      email: ' sanjeet2012@yahoo.com ',
      profession: 'Consultant Endodontist',
      description:
        'Dr. Ranjit is one of the brightest endodontists in Nepal. He did his BDS from BPKIHS, Dharan in 2013. He was one of the toppers of his batch. He is the only Endodontist to be graduated from the esteemed institute of AIIMS in Nepal. He also worked as a lecturer in Patan Hospital. He has a special interest in traveling to far-flung places and conducting free dental camps to needy people. His expertise in the field of Endodontics is unrivaled.',
      img: '../../../assets/images/1622964160.jpg',
    },
    {
      name: 'Dr. Bidhan Shrestha',
      email: ' bidhanbpkihs@gmail.com ',
      profession: 'Consultant Prosthodontist , Crown and bridge',
      description:
        'Dr. Shrestha is one of the forerunners in the field of Prosthodontics and Implantology in Nepal. He did his BDS from BPKIHS Dharan in 2012 and Master in Prosthodontics from the same institute. He is currently working as a Lecturer at Kantipur Dental college. He has a special interest in research and has 12 articles in his bag with various foreign authors. He is now considered an expert in the field of implantology.',
      img: '../../../assets/images/1622964318.jpg',
    },
    {
      name: 'Dr. Arun Kumar Mahat',
      email: ' dr.arunmahat@gmail.com ',
      profession: 'Consultant Maxillofacial surgeon',
      description:
        'Dr. Ranjit is one of the brightest endodontists in Nepal. He did his BDS from BPKIHS, Dharan in 2013. He was one of the toppers of his batch. He is the only Endodontist to be graduated from the esteemed institute of AIIMS in Nepal. He also worked as a lecturer in Patan Hospital. He has a special interest in traveling to far-flung places and conducting free dental camps to needy people. His expertise in the field of Endodontics is unrivaled.',
      img: '../../../assets/images/1622967357.jpg',
    },
    {
      name: 'Sujata Karki',
      profession: 'Dental Hyigenist',
      img: '../../../assets/images/1622969269.jpg',
    },
    {
      name: 'Ranjana Jabegu Limbu',
      profession: 'Dental assistant',
      img: '../../../assets/images/1622969551.jpg',
    },
  ];
  constructor() {}

  ngOnInit(): void {}
}
