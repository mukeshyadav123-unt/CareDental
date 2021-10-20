import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { MainLayoutRoutingModule } from './main-layout-routing.module';
import { MainLayoutComponent } from './main-layout.component';
import { SidebarComponent } from 'src/app/shared/sidebar/sidebar.component';
import { NgChatModule } from 'ng-chat';

@NgModule({
  declarations: [MainLayoutComponent, SidebarComponent],
  imports: [CommonModule, MainLayoutRoutingModule, NgChatModule],
  exports: [MainLayoutComponent],
})
export class MainLayoutModule {}
