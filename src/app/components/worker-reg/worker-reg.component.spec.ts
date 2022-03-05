import { ComponentFixture, TestBed } from '@angular/core/testing';

import { WorkerRegComponent } from './worker-reg.component';

describe('WorkerRegComponent', () => {
  let component: WorkerRegComponent;
  let fixture: ComponentFixture<WorkerRegComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ WorkerRegComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(WorkerRegComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
