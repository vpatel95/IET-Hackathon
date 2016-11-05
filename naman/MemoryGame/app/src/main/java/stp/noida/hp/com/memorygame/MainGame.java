package stp.noida.hp.com.memorygame;

import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Color;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.GridLayout;
import android.widget.GridView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.Hashtable;
import java.util.Map;

import static java.lang.System.exit;

public class MainGame extends AppCompatActivity {
Button b11,b12,b13,b21,b22,b23,b31,b32,b33;
    Handler handler;
    anim1 tlist=new anim1();
    int ar[]={11,12,13,21,22,23,31,32,33};
    int i=0,flag1=0;
    int stat=0;
    int level=1;
    String[] co={"#81D4FA","#FFE082","#FFAB91","#80CBC4"};
int[] test1={11,31,32,21,11};

String UPLOAD_URL="http://localhost/IET-Hackathon/ved/functions/index.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main_game);
         b11=(Button)findViewById(R.id.first1);

        b12=(Button)findViewById(R.id.first2);

        b13=(Button)findViewById(R.id.first3);
         b21=(Button)findViewById(R.id.second1);
         b22=(Button)findViewById(R.id.second2);
         b23=(Button)findViewById(R.id.second3);
         b31=(Button)findViewById(R.id.third1);
         b32=(Button)findViewById(R.id.third2);
         b33=(Button)findViewById(R.id.third3);

clickon();
Button bl=(Button)findViewById(R.id.button);
        bl.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                i = 0;
                for (int j = 0; j < 9; j++)
             disabling(false);
           gamestart(ar[i]);

            }
        });
   //opening();
    }
    private void disabling(boolean tr){
        b11.setEnabled(tr);
        b12.setEnabled(tr);
        b13.setEnabled(tr);
        b21.setEnabled(tr);
        b22.setEnabled(tr);
        b23.setEnabled(tr);
        b31.setEnabled(tr);
        b32.setEnabled(tr);
        b33.setEnabled(tr);



    }
    ///////////////////////////////////////////////////////////////////////////////////////
    protected int test(int a,int c){
        System.out.println(">>"+a+" "+level+" "+stat+" "+c);
        if(test1[a]==c){

            return a+1;
        }
        else
        {return  0;}
    }

    protected void gamestart(int select){
        Animation an= AnimationUtils.loadAnimation(getApplicationContext(), R.anim.fade);
        an.setAnimationListener(tlist);
        switch(select){
            case 11: b11.startAnimation(an);
                    break;
            case 12: b12.startAnimation(an);
                break;
            case 13: b13.startAnimation(an);
                break;
            case 21: b21.startAnimation(an);
                break;
            case 22: b22.startAnimation(an);
                break;
            case 23: b23.startAnimation(an);
                break;
            case 31: b31.startAnimation(an);
                break;
            case 32: b32.startAnimation(an);
                break;
            case 33: b33.startAnimation(an);
                break;
           default:  exit(0);
        }

    }
    public class anim1 implements Animation.AnimationListener  {
        @Override
        public void onAnimationStart(Animation animation) {

        }

        @Override
        public void onAnimationEnd(Animation animation) {
          if(i<test1.length-1){ gamestart(test1[++i]);}
            if(i==test1.length-1){

                    disabling(true);
            }
        }

        @Override
        public void onAnimationRepeat(Animation animation) {

        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public void clickon() {
    b11.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            stat = test(stat, 11);
            if (stat == 0) {
               lose();
            } else if (stat == level) {
                success();

            }
        }
    });


    b12.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            stat = test(stat, 12);
            if (stat == 0) {
             lose();
            } else if (stat == level) {
                success();

            }
        }
    });

    b13.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            stat=test(stat,13);
            if(stat==0){
                lose();
            }
            else if(stat==level){
                success();

            }
        }
    });

    b21.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            stat=test(stat,21);
            if(stat==0){
              lose();
            }
            else if(stat==level){
                 success();

            }
        }
    });

    b22.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            stat=test(stat,22);
            if(stat==0){
              lose();
            }
            else if(stat==level){
                success();

            }
        }
    });

    b23.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            stat=test(stat,23);
            if(stat==0){
           lose();
            }
            else if(stat==level){
               success();

            }
        }
    });

    b31.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            stat=test(stat,31);
            if(stat==0){
               lose();

            }
            else if(stat==level){
                 success();

            }
        }
    });   b32.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            stat=test(stat,32);
            if(stat==0){
                lose();

            }
            else if(stat==level){
                success();

            }
        }
    });   b33.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            stat=test(stat,33);
            if(stat==0){
             lose();
            }
            else if(stat==level){
                success();

            }
        }
    });
}
    public void success(){
        Toast.makeText(getApplicationContext(),"win", Toast.LENGTH_LONG).show();
        level++;stat=0;
        Toast.makeText(MainGame.this, test1.toString(), Toast.LENGTH_LONG).show();
        uploadImage();
    }
    public void lose(){
        Toast.makeText(getApplicationContext(),"lose", Toast.LENGTH_LONG).show();
      //  i=0;
       // gamestart(ar[i]);
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
private void uploadImage(){
    //Showing the progress dialog
    final ProgressDialog loading = ProgressDialog.show(MainGame.this, "Uploading...", "Please wait...", false, false);
    StringRequest stringRequest = new StringRequest(Request.Method.POST, UPLOAD_URL,
            new Response.Listener<String>() {
                @Override
                public void onResponse(String s) {
                    //Disimissing the progress dialog
                    loading.dismiss();
                    if(s.trim().equals("success"))
                    {  Toast.makeText(MainGame.this, s, Toast.LENGTH_LONG).show();
                    }
                    else
                        Toast.makeText(MainGame.this, s, Toast.LENGTH_LONG).show();
                }
            },
            new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError volleyError) {
                    //Dismissing the progress dialog
                    loading.dismiss();

                    //Showing toast   + volleyError.getMessage().toString()
                    Toast.makeText(MainGame.this,"Error", Toast.LENGTH_LONG).show();
                }
            }){
        @Override
        protected Map<String, String> getParams() throws AuthFailureError {
            //Converting Bitmap to String


            //Getting Image Name
            String lev = level+"";
            String status=flag1+"";
            String pass="";
            for(int j=0;j<test1.length;j++){
                pass=pass+","+test1[j];
            }
          //  String pass=pass1.getText().toString().trim();
            //Creating parameters
            Map<String,String> params = new Hashtable<String, String>();
            //Adding paramet
            params.put("level",lev.trim());
            params.put("path",pass.trim());
            params.put("status",status.trim());
            params.put("task","updatepriority");

            //returning parameters
            return params;
        }
    };

    //Creating a Request Queue
    RequestQueue requestQueue = Volley.newRequestQueue(this);

    //Adding request to the queue
    requestQueue.add(stringRequest);
}
}
