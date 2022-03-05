import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BanneComponent } from './banne.component';

describe('BanneComponent', () => {
  let component: BanneComponent;
  let fixture: ComponentFixture<BanneComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BanneComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(BanneComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
