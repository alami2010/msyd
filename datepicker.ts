import {
  Component,
  ElementRef,
  Renderer,
  AfterViewChecked,
  AfterViewInit,
  forwardRef,
  NgModule,
  HostListener, Input,
} from '@angular/core';
import {NG_VALUE_ACCESSOR, ControlValueAccessor} from '@angular/forms';
import {CommonModule} from '@angular/common';
import {FormsModule} from '@angular/forms';
import {ViewFocusedElement} from '../model/viewfocus.element';
import {DomHandler} from '../service/domhandler.service';
import * as moment from 'moment';
import {LoggingService} from '../service/logging.service';
import {ViewCommon} from '../service/viewcommon.service';
import {DatepickerModule, TimepickerModule} from "ng2-bootstrap";

const RNL_VALUE_ACCESSOR: any = {
  provide: NG_VALUE_ACCESSOR,
  useExisting: forwardRef(() => MyRnlDatePickerComponent), useMulti: true
};

declare var $: any;
const noop = () => {
};


@Component({
  selector: 'my-rnl-datepicker',
  template: `
        <div class="input-group">
          <input type="text" id="tbxDate" (keypress)="eventHandlerInputKeyPress($event)"
            class="form-control" [(ngModel)]="dateTimeModel" (change)="changeValue($event)"
             (blur)="onTouchedCallback()" [disabled]="!enabled"/>
          <div class="input-group-btn">
            <button class="btn" (click)="showCalendar()" [disabled]="!enabled">
                <i class="fa fa-calendar"></i></button>
          </div>
        </div>
        <div id="calendar-popup" class="calendar-popup" tabindex="0" 
              [style.display]="panelVisible ? 'block' : 'none'" >
              
               <datepicker     [initDate]="value" (selectionDone)=\"changeModel($event)\" [(ngModel)]="datePicker" [showWeeks]="false" startingDay="1"   ></datepicker>
              <timepicker *ngIf="isCalendarWithTime"  class="timepicker" [(ngModel)]="timePicker" (change)="changed()"  [showMeridian]="!ismeridian" 
            [readonlyInput]="!isEnabled"></timepicker>
        </div>
      `,
  providers: [RNL_VALUE_ACCESSOR]
})
export class MyRnlDatePickerComponent extends ViewFocusedElement implements ControlValueAccessor,
  AfterViewChecked, AfterViewInit {


  public ismeridian: boolean = true;
  public isEnabled: boolean = true;
  timePicker: Date = new Date();
  isCalendarWithTime: boolean = false;


  @Input()
  dateFormat: any;
  datePicker: any;
  dateTimeModel: any;
  // input: any;
  panel: any;
  datePickerPageShown: any;
  panelVisible: boolean;
  documentClickListener: any;
  width: string;
  isShowing: boolean;
  selectionDate: Date;
  input: HTMLInputElement;

  eventHandlerInputKeyPress(event) {
    console.log(event, event.keyCode, event.keyIdentifier);
  }

  constructor(private domHandler: DomHandler,
              private el: ElementRef,
              private renderer: Renderer,
              private log: LoggingService,
              viewCommon: ViewCommon) {
    super();
    this.panelVisible = false;
    this.id = this.el.nativeElement.id;
    viewCommon.registerComponentElement(this);
    this.datePicker = new Date;
  }

  @HostListener('click', ['$event'])
  onClick(e: Event) {
    if (this.panelVisible) {
      console.log('dtp prevent default', this.panelVisible);
      e.preventDefault();
      e.stopPropagation();
    }
  }


  ngAfterViewChecked() {

    if (this.domHandler.findSingle(this.el.nativeElement, 'daypicker').childElementCount > 0) {
      this.datePickerPageShown = 'DP_DAYS';
    } else if (this.domHandler.findSingle(this.el.nativeElement, 'monthpicker').childElementCount > 0) {
      this.datePickerPageShown = 'DP_MONTH';
    } else if (this.domHandler.findSingle(this.el.nativeElement, 'yearpicker').childElementCount > 0) {
      this.datePickerPageShown = 'DP_YEARS';
    } else {
      console.error("datePickerPageShown" + this.datePickerPageShown);
    }
  }

  ngOnInit() {
    console.log("hello world");
    console.log("hello world" + this.dateFormat);

    // If date format is not set, the following default format will be applied:
    if (this.dateFormat) {
      // check if date format contains time
      this.isCalendarWithTime = this.dateFormat.toUpperCase().includes('H');
    }
    else if (this.dateFormat) {
      this.dateFormat = 'DD/MM/YYYY';
    }


    this.input = this.domHandler.findSingle(this.el.nativeElement, 'input');
    console.log(this.domHandler.findSingle(this.el.nativeElement, 'daypicker'));
    this.documentClickListener = this.renderer.listenGlobal('body', 'click', (e) => {
      let sourceEl = e.srcElement;
      console.log('DTP get closest...');
      if (this.domHandler.getClosest(sourceEl, '#calendar-popup') === null) {
        this.hide();
      }
      return true;
    });
  }

  ngAfterViewInit() {
    this.panel = this.domHandler.findSingle(this.el.nativeElement, 'div.calendar-popup');
    console.log('DateTimePicker AfterInit', this.input, this.panel);
    if (this.datePicker) {
      this.selectionDate =
        moment(this.input.value, this.dateFormat).toDate();
      this.input.value = this.converFromDate(this.datePicker); // Change here for date type
    }
  }

  converFromDate(value: any): string {
    if (value instanceof Date) {
      return moment(value).format(this.dateFormat);
    } else {
      return value;
    }
  }

  convertToDate(value: any): Date {
    if (value instanceof Date) {
      return value;
    }
    return moment(value, this.dateFormat).toDate();
  }

  align() {
    this.domHandler.relativePosition(this.panel, this.el.nativeElement.children[0]);
  }

  showCalendar() {
    $(this.domHandler.findSingle(this.el.nativeElement, 'daypicker')).find('button.active').click();
    console.info('show is called');
    this.isShowing = true;
    if (!this.panelVisible) {
      console.log('dtp showing...');
      this.panelVisible = true;
      this.panel.style.zIndex = 1000; // ++PUI.zindex;
      this.align();
      this.domHandler.fadeIn(this.panel, 300);
      this.panel.focus();
    }
  }


  processKeyPressForTimePicker(e: any, isFirst: boolean) {
    // enter and bigDown
    if (e.keyCode === 13) {
      this.changeModel(this.datePicker);
      return false;
    }
    let indexInput: number = isFirst ? 0 : 1;
    // key down
    if (e.keyCode === 40) {
      $(this.domHandler.findSingle(this.el.nativeElement, 'timepicker')).find('tbody a').get(2 + indexInput).click();
    }
    // Key up
    if (e.keyCode === 38) {
      $(this.domHandler.findSingle(this.el.nativeElement, 'timepicker')).find('tbody a').get(indexInput).click();
    }
    return true;
  }


  processKeyPressForDays(e: any) {
    // enter and bigDown
    if (e.keyCode === 13 || e.keyCode == 34) {
      this.changeModel(this.datePicker);
      $(this.domHandler.findSingle(this.el.nativeElement, 'daypicker')).find('button.active').click();
      return false;
    }
    // up to months
    if (e.keyCode === 33) {
      $(this.domHandler.findSingle(this.el.nativeElement, 'daypicker')).find('thead button').get(1).click();
    }
    // key down
    if (e.keyCode === 40) {
      this.datePicker = moment(this.datePicker).add('days', +7).toDate();
    }
    // Key up
    if (e.keyCode === 38) {
      this.datePicker = moment(this.datePicker).add('days', -7).toDate();
    }
    //Key right
    if (e.keyCode === 39) {
      this.datePicker = moment(this.datePicker).add('days', +1).toDate();
    }
    //page left
    if (e.keyCode === 37) {
      this.datePicker = moment(this.datePicker).add('days', -1).toDate();
    }
    // key down
    if (!this.panelVisible && (e.keyCode === 40 || e.keyCode === 38)) {
      this.showCalendar();
    }
    return true;
  }


  processKeyPressForMonths(e: any) {


    // enter
    if (e.keyCode === 13 || e.keyCode == 34) {
      $(this.domHandler.findSingle(this.el.nativeElement, 'monthpicker')).find('tbody button.active').click();
    }


    // up to years
    if (e.keyCode === 33) {
      $(this.domHandler.findSingle(this.el.nativeElement, 'monthpicker')).find('thead button').get(1).click();
    }

    // key down
    if (e.keyCode === 40) {
      this.datePicker = moment(this.datePicker).add('month', +3).toDate();
    }
    // Key up
    if (e.keyCode === 38) {
      this.datePicker = moment(this.datePicker).add('month', -3).toDate();
    }
    //Key right
    if (e.keyCode === 39) {
      this.datePicker = moment(this.datePicker).add('month', +1).toDate();
    }
    //page left
    if (e.keyCode === 37) {
      this.datePicker = moment(this.datePicker).add('month', -1).toDate();
    }
  }


  processKeyPressForYears(e: any) {
    // enter
    if (e.keyCode === 13 || e.keyCode == 34) {
      console.log(this.datePicker.getMonth());
      $(this.domHandler.findSingle(this.el.nativeElement, 'yearpicker')).find('tbody button.active').click();
    }
    // key down
    if (e.keyCode === 40) {
      this.datePicker = moment(this.datePicker).add('year', +5).toDate();
    }
    // Key up
    if (e.keyCode === 38) {
      this.datePicker = moment(this.datePicker).add('year', -5).toDate();
    }
    //Key right
    if (e.keyCode === 39) {
      this.datePicker = moment(this.datePicker).add('year', +1).toDate();
    }
    //page left
    if (e.keyCode === 37) {
      this.datePicker = moment(this.datePicker).add('year', -1).toDate();
    }
  }


  hide() {
    // console.log('Hiding component...');
    // if(!this.isShowing) {
    //   this.panelVisible = false;
    // }
    // this.isShowing = false;
    this.panelVisible = false;
  }


  ngOnDestroy() {
    if (this.documentClickListener) {
      this.documentClickListener();
    }
  }


  changeValue(e: any) {

    this.onChangeCallback(e.srcElement.value); // change here for date type...
    this.selectionDate = moment(e.srcElement.value, this.dateFormat).toDate();
    this.datePicker = this.selectionDate;
    this.timePicker = this.selectionDate;

    this.hide();
  }


  changeModel(newDate) {
    console.log("changeModel info" + newDate)
    if (this.datePickerPageShown == 'DP_DAYS') {
      var newDateTime = new Date(newDate.getFullYear(), newDate.getMonth(), newDate.getDate(),
        this.timePicker.getHours(), this.timePicker.getMinutes(), this.timePicker.getSeconds());

      this.dateTimeModel = moment(newDateTime).format(this.dateFormat);
      this.hide()
    }
  }




  @HostListener('keydown', ['$event'])
  onKeyDown(e: KeyboardEvent) {
    let element: Element = e.srcElement;


    console.log('---------keydown-----------------------');
    console.log('e.keyCode '+e.keyCode);
    console.log('----------------        ----------------');

      //echap
    if (e.keyCode === 27) {
      this.hide();
    }
    // key down up
    if (!this.panelVisible && (e.keyCode === 40 || e.keyCode === 38)) {
      this.showCalendar();
      return true;
    }

    // check if is the focus on timepicker input
    if (element.tagName.toLowerCase() == 'input' && element.getAttribute('type') == 'text') {
      let isFirstInput = $(element).parent().is(':first-child');
      return this.processKeyPressForTimePicker(e, isFirstInput);
    }


    switch (this.datePickerPageShown) {
      case 'DP_DAYS':
        return this.processKeyPressForDays(e);
      case 'DP_MONTH':
        this.processKeyPressForMonths(e);
        return
      case 'DP_YEARS':
        this.processKeyPressForYears(e);
        break;
    }


    return true;


  }

//The internal data model
  private innerValue: any = new Date();

  //Placeholders for the callbacks which are later providesd
  //by the Control Value Accessor
  private onTouchedCallback: () => void = noop;
  private onChangeCallback: (_: any) => void = noop;

  //get accessor
  get value(): any {
    return this.innerValue;
  };

  //set accessor including call the onchange callback
  set value(v: any) {
    if (v !== this.innerValue) {
      this.innerValue = v;
      this.onChangeCallback(v);
    }
  }

  //Set touched on blur
  onBlur() {
    this.onTouchedCallback();
  }

  //From ControlValueAccessor interface
  writeValue(value: any) {
    if (value !== this.innerValue) {
      this.innerValue = value;
    }
  }

  //From ControlValueAccessor interface
  registerOnChange(fn: any) {
    this.onChangeCallback = fn;
  }

  //From ControlValueAccessor interface
  registerOnTouched(fn: any) {
    this.onTouchedCallback = fn;
  }
}

@NgModule({
  exports: [MyRnlDatePickerComponent],
  declarations: [MyRnlDatePickerComponent],
  imports: [CommonModule, FormsModule, DatepickerModule, TimepickerModule]
})
export class MyRnlDatePickerModule {
}
