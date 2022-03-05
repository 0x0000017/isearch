import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CworkerComponent } from './cworker.component';

describe('CworkerComponent', () => {
  let component: CworkerComponent;
  let fixture: ComponentFixture<CworkerComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CworkerComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CworkerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
