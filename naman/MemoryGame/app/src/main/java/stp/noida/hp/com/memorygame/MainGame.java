package stp.noida.hp.com.memorygame;

import android.graphics.Color;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.GridLayout;
import android.widget.GridView;

public class MainGame extends AppCompatActivity {
Button b11,b12,b13,b21,b22,b23,b31,b32,b33;
    Handler handler;
    String[] co={"#81D4FA","#FFE082","#FFAB91","#80CBC4"};
int[] test1={11,31,32,21,11};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main_game);
       b11=(Button)findViewById(R.id.first1);
        b11.setBackgroundColor(Color.parseColor(co[0]));
        GridLayout g=(GridLayout)findViewById(R.id.low);
        g.setVisibility(View.VISIBLE);

  // opening();
    }
    protected int test(int a,int c){
        if(test1[a]==c){
            return a;
        }
        else
        {return  0;}
    }
    protected void opening(){
        handler = new Handler();

        final Runnable r = new Runnable() {
            public void run() {
          Button b11=(Button)findViewById(R.id.first1);
            Button b12=(Button)findViewById(R.id.first2);
            Button b13=(Button)findViewById(R.id.first3);
            Button b21=(Button)findViewById(R.id.second1);
            Button b22=(Button)findViewById(R.id.second2);
            Button b23=(Button)findViewById(R.id.second3);
            Button b31=(Button)findViewById(R.id.third1);
            Button b32=(Button)findViewById(R.id.third2);
            Button b33=(Button)findViewById(R.id.third3);
            /////////////////////////////////////////////////
                b11.setBackgroundColor(Color.parseColor(co[0]));
                handler.postDelayed(this, 250);
                b12.setBackgroundColor(Color.parseColor(co[1]));
                handler.postDelayed(this, 250);
                b13.setBackgroundColor(Color.parseColor(co[2]));
                handler.postDelayed(this, 250);
                b21.setBackgroundColor(Color.parseColor(co[3]));
                handler.postDelayed(this, 250);
                b31.setBackgroundColor(Color.parseColor(co[0]));
                handler.postDelayed(this, 250);
                b22.setBackgroundColor(Color.parseColor(co[1]));
                handler.postDelayed(this,250);
                b23.setBackgroundColor(Color.parseColor(co[2]));
                handler.postDelayed(this,250);
                b32.setBackgroundColor(Color.parseColor(co[3]));
                handler.postDelayed(this,250);
                b33.setBackgroundColor(Color.parseColor(co[0]));
                handler.postDelayed(this,250);
            }
        };

        handler.postDelayed(r, 2250);
    }
}
