package stp.noida.hp.com.memorygame;

import android.animation.Animator;
import android.animation.AnimatorInflater;
import android.animation.AnimatorSet;
import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.graphics.Color;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.animation.AlphaAnimation;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.GridLayout;
import android.widget.GridView;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.ArrayList;
import java.util.Hashtable;
import java.util.Map;
import java.util.Random;

import static java.lang.System.exit;

public class MainGame extends AppCompatActivity {
Button b11,b12,b13,b21,b22,b23,b31,b32,b33,but;
    Handler handler;
    String path2="";
    anim1 tlist=new anim1();
    private SQLiteDatabase db;
    int ar[]={11,12,13,21,22,23,31,32,33};
    int i=0,flag1=1;
    int stat=0;
    int update1,priority;
    String pathe="";
   String pathlo="";
    int level=1,value1,value2=0;
    String[] co={"#81D4FA","#FFE082","#FFAB91","#80CBC4"};
    ArrayList<Integer> path,path1;
int[] test1={11,31,32,21,11};
//    String UPLOAD_URL="http://10.5.58.21/IET-Hackathon/ved/index.php";
String UPLOAD_URL="http://ved.pe.hu/index.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main_game);
         b11=(Button)findViewById(R.id.first1);
           createDatabase();
        b12=(Button)findViewById(R.id.first2);

        b13=(Button)findViewById(R.id.first3);
         b21=(Button)findViewById(R.id.second1);
         b22=(Button)findViewById(R.id.second2);
         b23=(Button)findViewById(R.id.second3);
         b31=(Button)findViewById(R.id.third1);
         b32=(Button)findViewById(R.id.third2);
         b33=(Button)findViewById(R.id.third3);
        deleteTitle();//server
        TextView t1=(TextView)findViewById(R.id.best);
        t1.setText("Press Play To START");
        TextView t=(TextView)findViewById(R.id.textView);
        SharedPreferences prefs = getSharedPreferences("potential", MODE_PRIVATE);
        level=prefs.getInt("level",1);

        t.setText("LEVEL "+(level));
try {
    generator(1);

}catch (Exception e){}
clickon();
        levelupdate();//server
Button bl=(Button)findViewById(R.id.button);
        bl.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                i = 0;value2++;
                TextView t1=(TextView)findViewById(R.id.best);
                t1.setText("Remember..");
                for (int j = 0; j < 9; j++)
             disabling(false);
           gamestart(path.get(i));

            }
        });
   //opening();
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    private void levelupdate()
    {
        final ProgressDialog loading = ProgressDialog.show(MainGame.this, "Getting Info...", "Please wait...", false, false);
        StringRequest stringRequest = new StringRequest(Request.Method.POST, UPLOAD_URL,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String s) {
                        //Disimissing the progress dialog
                        loading.dismiss();
                        System.out.println(s+".......................................................");
                        if(!s.equals(""))
                       level=Integer.parseInt(s);
                        //  Toast.makeText(MainGame.this, s, Toast.LENGTH_LONG).show();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError volleyError) {
                        //Dismissing the progress dialog
                        loading.dismiss();

                        //Showing toast   + volleyError.getMessage().toString()
                      //  Toast.makeText(MainGame.this,"Error", Toast.LENGTH_LONG).show();
                    }
                }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                //Converting Bitmap to String


                //Getting Image Name
                SharedPreferences prefs = getSharedPreferences("potential", MODE_PRIVATE);
                String check=prefs.getString("username","");
                String status=flag1+"";

                   System.out.println(">>>>>>>>>>"+check);
                //  String pass=pass1.getText().toString().trim();
                //Creating parameters
                Map<String,String> params = new Hashtable<String, String>();
                //Adding paramet
                params.put("username",check.trim());

                params.put("task","getlevel");

                //returning parameters
                return params;
            }
        };

        //Creating a Request Queue
        RequestQueue requestQueue = Volley.newRequestQueue(this);

        //Adding request to the queue
        requestQueue.add(stringRequest);

    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
       {
          System.out.println(">>" + a + " " + level + " " + stat + " " + c);
          if (path.get(a) == c) {

              return a + 1;
          } else {
              return 0;
          }
      }

    }

    protected void gamestart(int select){
        Animation an= AnimationUtils.loadAnimation(getApplicationContext(), R.anim.fade);
        an.setAnimationListener(tlist);
        switch(select){
            case 11: b11.startAnimation(an);
                    break;
            case 12: b12.startAnimation(an);
                break;
            case 13: ;b13.startAnimation(an);
                break;
            case 21: ;b21.startAnimation(an);
                break;
            case 22: b22.startAnimation(an);
                break;
            case 23:; b23.startAnimation(an);
                break;
            case 31:; b31.startAnimation(an);
                break;
            case 32:; b32.startAnimation(an);
                break;
            case 33:; b33.startAnimation(an);
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
            if(i<path.size()-1){ gamestart(path.get(++i));}
            if(i==path.size()-1){

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
           AlphaAnimation buttonClick = new AlphaAnimation(1F, 0.8F);
            b11.startAnimation(buttonClick);
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
            AlphaAnimation buttonClick = new AlphaAnimation(1F, 0.8F);
            b12.startAnimation(buttonClick);
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
            AlphaAnimation buttonClick = new AlphaAnimation(1F, 0.8F);
            b13.startAnimation(buttonClick);
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
            AlphaAnimation buttonClick = new AlphaAnimation(1F, 0.8F);
            b21.startAnimation(buttonClick);
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
            AlphaAnimation buttonClick = new AlphaAnimation(1F, 0.8F);
            b22.startAnimation(buttonClick);
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
            AlphaAnimation buttonClick = new AlphaAnimation(1F, 0.8F);
            b23.startAnimation(buttonClick);
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
            AlphaAnimation buttonClick = new AlphaAnimation(1F, 0.8F);
            b31.startAnimation(buttonClick);
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
            AlphaAnimation buttonClick = new AlphaAnimation(1F, 0.8F);
            b32.startAnimation(buttonClick);
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
            AlphaAnimation buttonClick = new AlphaAnimation(1F, 0.8F);
            b33.startAnimation(buttonClick);
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
     //   Toast.makeText(getApplicationContext(),"win", Toast.LENGTH_LONG).show();
        TextView t=(TextView)findViewById(R.id.textView);
        t.setText("LEVEL "+(level+1));
        TextView t1=(TextView)findViewById(R.id.best);
        t1.setText("Press Play To START");

        path1  =new ArrayList<Integer>();
        value1=level;
        int z=0;
        while(z<path.size()||z==0)
           {   path1.add(path.get(z)); System.out.println(".................."+path1.get(z));z++;
           }
        String pass="";
        for(int j=0;j<path1.size();j++){
            pass=pass+","+path1.get(j);
        } path2=pass;

        flag1=1;
        SharedPreferences.Editor editor = getSharedPreferences("potential", MODE_PRIVATE).edit();
        editor.putInt("level",level );
        editor.commit();
        uploadImage();
        for (int j = 0; j < 9; j++)
            disabling(false);
        levelo();
      animating();

    }
    public  void animating(){
        //////////////////////////////////////////////
        final Dialog dialog = new Dialog(MainGame.this);
        // Include dialog.xml file
        dialog.setContentView(R.layout.custom_dialog);
        // Set dialog title


        // set values for custom dialog components - text, image and button
        TextView text = (TextView) dialog.findViewById(R.id.level);
        text.setText("Level "+value1);
        ImageView image = (ImageView) dialog.findViewById(R.id.star1);
        ImageView image2 = (ImageView) dialog.findViewById(R.id.star2);
        ImageView image3 = (ImageView) dialog.findViewById(R.id.star3);
        System.out.println(value2+"><><><");
        if(value2==0){
            image.setImageResource(R.drawable.star);
            image3.setImageResource(R.drawable.star);
        image2.setImageResource(R.drawable.star);
        }else if(value2==1)
        {
            image.setImageResource(R.drawable.star);
            image3.setImageResource(R.drawable.star);
            image2.setImageResource(R.drawable.starw);
        }else {
            image.setImageResource(R.drawable.star);
            image3.setImageResource(R.drawable.starw);
            image2.setImageResource(R.drawable.starw);
        }
        dialog.setCancelable(false);
        dialog.setCanceledOnTouchOutside(false);
        dialog.show();
Button dialogb=(Button)dialog.findViewById(R.id.again);
     dialogb.setOnClickListener(new View.OnClickListener() {
         @Override
         public void onClick(View v) {
             dialog.dismiss();generator(1); TextView t=(TextView)findViewById(R.id.textView);
             t.setText("LEVEL "+(level)); value2=0;
             LinearLayout l=(LinearLayout)findViewById(R.id.low);
             AnimatorSet set = (AnimatorSet) AnimatorInflater.loadAnimator(getApplicationContext(),R.animator.animate);
             set.setTarget(l);
             set.start();
         }
     });
        Button dialogb1=(Button)dialog.findViewById(R.id.next);
        dialogb1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                level++;stat=0; value2=0;
                try {
                    generator(1);

                }catch (Exception e){}
                dialog.dismiss();
                LinearLayout l=(LinearLayout)findViewById(R.id.low);
                AnimatorSet set = (AnimatorSet) AnimatorInflater.loadAnimator(getApplicationContext(),R.animator.animate);
                set.setTarget(l);
                set.start();
            }
        });
        //////////////////////////////////////////////////

    }
    public void lose(){
     //   Toast.makeText(getApplicationContext(),"lose", Toast.LENGTH_LONG).show();
        path1  =new ArrayList<Integer>();
        value1=level;
        value2=0;
        int z=0;
        for (int j = 0; j < 9; j++)
            disabling(false);
        TextView t1=(TextView)findViewById(R.id.best);
        t1.setText("Try Again");
        while(z<path.size()||z==0)
        {   path1.add(path.get(z));z++;
        }
        String pass="";
        for(int j=0;j<path1.size();j++){
            pass=pass+","+path1.get(j);
        } path2=pass;
      //  i=0;
        flag1=-1;
        uploadImage();
       // gamestart(ar[i]);
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
private void uploadImage(){
    //Showing the progress dialog


    StringRequest stringRequest = new StringRequest(Request.Method.POST, UPLOAD_URL,
            new Response.Listener<String>() {
                @Override
                public void onResponse(String s) {
                    //Disimissing the progress dialog

                    if(s.trim().equals(""))
                    {  insertIntoDB();
                    }
                    else{
                        if(!s.equals("nopath"))
                        { pathlo=s;
                        generator(2);}
                    }
                      //  Toast.makeText(MainGame.this, s, Toast.LENGTH_LONG).show();
                }
            },
            new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError volleyError) {
                    //Dismissing the progress dialog

                    insertIntoDB();
                    //Showing toast   + volleyError.getMessage().toString()
                    Toast.makeText(MainGame.this,"Error"+volleyError, Toast.LENGTH_LONG).show();
                }
            }){
        @Override
        protected Map<String, String> getParams() throws AuthFailureError {
            //Converting Bitmap to String


            //Getting Image Name
            String lev = value1+"";
            String status=flag1+"";


          //  String pass=pass1.getText().toString().trim();
            //Creating parameters
            Map<String,String> params = new Hashtable<String, String>();
            //Adding paramet
            params.put("level",lev.trim());
            params.put("path",path2.trim());
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
    /////////////////////////////////////////////////////////////////////////////////////////////////
    private void generator(int z){
        int l,pos;
      path  =new ArrayList<Integer>();
        if(z==2){
            pathlo=pathlo.substring(1,pathlo.length());

            String[] arr = pathlo.split(",");
            for(l=0;l<arr.length;l++){
                path.add(Integer.parseInt(arr[l]));
            }



        }else{
        Random random = new Random();
        for (l=0;l<level;l++) {
            pos=random.nextInt(9);

            if(l!=0){
            if (!(path.get(l-1)==ar[pos])){
                   path.add(ar[pos]);
                Log.i("generator: ",path.get(l)+"<<<");

               }else {l--;;}

        }else{ path.add(ar[pos]); }
        }}
    }
///////////////////////////////////////////////////////////////////////////////////////////////////
protected void createDatabase(){
    db=openOrCreateDatabase("PersonDB", Context.MODE_PRIVATE, null);
    db.execSQL("CREATE TABLE IF NOT EXISTS product(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, level NUMBER(6), path VARCHAR(225), priority NUMBER(6) );");
    //  Toast.makeText(getApplicationContext(),"Saved Successfully", Toast.LENGTH_LONG).show();
}
    protected void insertIntoDB(){
       try{
                Cursor c=db.rawQuery("SELECT * FROM product WHERE path='"+path2+"'", null);
                if(c.moveToFirst())
                {
                    String strSQL = "UPDATE product SET priority ="+(Integer.parseInt(c.getString(3))-flag1)+" WHERE id = "+ Integer.parseInt(c.getString(0));

                    db.execSQL(strSQL);
                    System.out.println("Error" + "Record exist");
                }
                else
                {
                    // Inserting record

                    String query = "INSERT INTO product (level,path,priority) VALUES('"+value1+"', '"+path2+"', '"+flag1+"' );";
                    db.execSQL(query);
                    //Toast.makeText(getApplicationContext(),"Saved Successfully", Toast.LENGTH_LONG).show();
                    }
                    } catch(Exception e){System.out.println(e+"");}
    }
    public void deleteTitle()
    {
        Cursor c=db.rawQuery("SELECT * FROM product WHERE priority=(SELECT max(priority) FROM product) ", null);
        c.moveToFirst();
       try{ while (c.getString(1)!=null){
        update1=Integer.parseInt(c.getString(1))    ;
            pathe=c.getString(2);
            priority=Integer.parseInt(c.getString(3));
            serverside();
            c.moveToNext();
        }}catch (Exception e){}
    }
    private void serverside(){
        //Showing the progress dialog

        StringRequest stringRequest = new StringRequest(Request.Method.POST, UPLOAD_URL,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String s) {
                        //Disimissing the progress dialog

                        Log.i("tag", s);
                      //  Toast.makeText(getApplicationContext(),""+s,Toast.LENGTH_LONG).show();
                        if(s.trim().equals("success"))
                        {
                            db.execSQL("DELETE FROM product");
                        }
                        else{}
                        //  Toast.makeText(MainGame.this, s, Toast.LENGTH_LONG).show();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError volleyError) {
                        //Dismissing the progress dialog


                        //Showing toast   + volleyError.getMessage().toString()
                    //    Toast.makeText(MainGame.this,"Error"+volleyError, Toast.LENGTH_LONG).show();
                    }
                }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                //Converting Bitmap to String


                //Getting Image Name
                String lev = value1+"";
                String status=flag1+"";
            //   pathe

                //  String pass=pass1.getText().toString().trim();
                //Creating parameters
                Map<String,String> params = new Hashtable<String, String>();
                //Adding paramet
                params.put("level",update1+"".trim());
                params.put("path",pathe.trim());
                params.put("status",priority+"");
                params.put("task","updateserver");

                //returning parameters
                return params;
            }
        };

        //Creating a Request Queue
        RequestQueue requestQueue = Volley.newRequestQueue(this);

        //Adding request to the queue
        requestQueue.add(stringRequest);
    }
    private void levelo(){
        //Showing the progress dialog

        StringRequest stringRequest = new StringRequest(Request.Method.POST, UPLOAD_URL,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String s) {
                        //Disimissing the progress dialog

                       System.out.println(s+"6uygyyjjhy");

                        if(s.trim().equals("success"))
                        {

                        }
                        else{}
                        //  Toast.makeText(MainGame.this, s, Toast.LENGTH_LONG).show();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError volleyError) {
                        //Dismissing the progress dialog


                        //Showing toast   + volleyError.getMessage().toString()
                  //      Toast.makeText(MainGame.this,"Error"+volleyError, Toast.LENGTH_LONG).show();
                    }
                }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                //Converting Bitmap to String


                //Getting Image Name
                SharedPreferences prefs = getSharedPreferences("potential", MODE_PRIVATE);
                String check=prefs.getString("username","");

                String status=flag1+"";

                   System.out.println(check+"%%%%%%%%%");
                //  String pass=pass1.getText().toString().trim();
                //Creating parameters
                Map<String,String> params = new Hashtable<String, String>();
                //Adding paramet
                params.put("username",check.trim());
                params.put("level",value1+"".trim());
                params.put("task","levelupdate");

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
