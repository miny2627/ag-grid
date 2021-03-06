// Type definitions for @ag-grid-community/core v24.1.0
// Project: http://www.ag-grid.com/
// Definitions by: Niall Crosby <https://github.com/ag-grid/>
import { DraggingEvent, DragSourceType, DropTarget } from "../dragAndDrop/dragAndDropService";
import { GridPanel } from "../gridPanel/gridPanel";
import { BeanStub } from "../context/beanStub";
export interface DropListener {
    getIconName(): string;
    onDragEnter(params: DraggingEvent): void;
    onDragLeave(params: DraggingEvent): void;
    onDragging(params: DraggingEvent): void;
    onDragStop(params: DraggingEvent): void;
}
export declare class BodyDropTarget extends BeanStub implements DropTarget {
    private dragAndDropService;
    private columnController;
    private gridOptionsWrapper;
    private gridPanel;
    private pinned;
    private eContainer;
    private eSecondaryContainers;
    private dropListeners;
    private currentDropListener;
    private moveColumnController;
    constructor(pinned: string, eContainer: HTMLElement);
    registerGridComp(gridPanel: GridPanel): void;
    isInterestedIn(type: DragSourceType): boolean;
    getSecondaryContainers(): HTMLElement[];
    getContainer(): HTMLElement;
    private init;
    getIconName(): string;
    private getDropType;
    onDragEnter(draggingEvent: DraggingEvent): void;
    onDragLeave(params: DraggingEvent): void;
    onDragging(params: DraggingEvent): void;
    onDragStop(params: DraggingEvent): void;
}
