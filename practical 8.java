package com.example.practical8;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.animation.AlphaAnimation;
import android.view.animation.Animation;
import android.view.animation.AnimationSet;
import android.view.animation.AnimationUtils;
import android.view.animation.ScaleAnimation;
import android.view.animation.TranslateAnimation;
import android.widget.ImageView;
import android.view.animation.RotateAnimation;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //Q1 fade in
        AlphaAnimation alphaAnimation = new AlphaAnimation(0.0f, 1.0f);
        alphaAnimation.setDuration(5000);
        ImageView iv = new ImageView(this);
        iv.setImageResource(R.drawable.scorpion);
        //iv.setAnimation(alphaAnimation);
        Animation an = AnimationUtils.loadAnimation(this, R.anim.alpha);
        //iv.startAnimation(an);
        RotateAnimation rotate = new
                RotateAnimation(0, 360, 150f, 150f);
        rotate.setDuration(5000);
        //iv.startAnimation(rotate);
        Animation am = AnimationUtils.loadAnimation(this, R.anim.rotate);
        //iv.startAnimation(am);
        ScaleAnimation scale = new
                ScaleAnimation(1.0f,2.0f,1.0f,2.0f,150f,150f);
        scale.setDuration(5000);
        //iv.startAnimation(scale);
        Animation ab = AnimationUtils.loadAnimation(this, R.anim.scale);
        //iv.startAnimation(ab);
        TranslateAnimation translate = new
                TranslateAnimation(0f,50f,0f,100f);
        translate.setDuration(5000);
        //iv.startAnimation(translate);
        Animation ac = AnimationUtils.loadAnimation(this, R.anim.translate);
        //iv.startAnimation(ac);
        AnimationSet set = new AnimationSet(true);
        set.addAnimation(an);
        set.addAnimation(am);
        set.addAnimation(ab);
        set.addAnimation(ac);
        iv.startAnimation(set);
        setContentView(iv);
    }
}
