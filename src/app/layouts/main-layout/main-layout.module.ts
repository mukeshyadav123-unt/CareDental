import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { MainLayoutRoutingModule } from './main-layout-routing.module';
import { MainLayoutComponent } from './main-layout.component';
import { SidebarComponent } from 'src/app/shared/sidebar/sidebar.component';

@NgModule({
  declarations: [MainLayoutComponent, SidebarComponent],
  imports: [CommonModule, MainLayoutRoutingModule],
  exports: [MainLayoutComponent],
})
export class MainLayoutModule {}
