package com.example.practical9;

import android.content.Context;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Paint;
import android.graphics.Path;
import android.util.AttributeSet;
import android.view.MotionEvent;
import android.view.View;

import androidx.annotation.Nullable;

public class TouchEventView extends View {
    private Paint paint = new Paint();
    private Path path = new Path();

    public TouchEventView(Context context, @Nullable AttributeSet attrs) {
        super(context, attrs);
        paint.setAntiAlias(true);
        paint.setStrokeWidth(10.0f);
        paint.setColor(Color.BLACK);
        paint.setStyle(Paint.Style.STROKE);
        paint.setStrokeJoin(Paint.Join.ROUND);

    }

    public TouchEventView(Context context) {
        super(context);

    }

    @Override
    protected void onDraw(@Nullable Canvas canvas){
        canvas.drawPath(path, paint);
    }

    @Override
    public boolean onTouchEvent(MotionEvent event){
        float coordinateX = event.getX();
        float coordinateY = event.getY();

        switch (event.getAction()){
            case MotionEvent.ACTION_DOWN:
                path.moveTo(coordinateX,coordinateY);
                return true;
            case MotionEvent.ACTION_MOVE:
                path.lineTo(coordinateX,coordinateY);
            case MotionEvent.ACTION_UP:
                //does nothing
                break;
            default:
                return  false;
        }

        //schedule a repaint of UI
        triggerRedraw();

        return super.onTouchEvent(event);
    }

    public void triggerRedraw(){
        invalidate();
    }

    public void clear(){
        path.reset();
        triggerRedraw();
    }
}
