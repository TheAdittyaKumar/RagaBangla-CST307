<?php
require_once __DIR__.'/_header.php';
require_login();
?>
<div class="card">
  <h1 class="header">Practice Tools</h1>
  <p class="muted">Simple WebAudio practice helpers (runs in the browser).</p>
  <div class="grid">
    <div class="card">
      <h3>Tanpura Drone</h3>
      <p>Play Sa–Pa–Sa drone. Choose base note and start.</p>
      <label>Base (Hz):</label>
      <input class="input" id="baseHz" type="number" step="0.1" value="261.63">
      <button class="btn" onclick="startDrone()">Start</button>
      <button class="btn" onclick="stopDrone()">Stop</button>
      <small class="muted">Tip: 261.63=Sa in C.</small>
    </div>
    <div class="card">
      <h3>Metronome / Tabla Click</h3>
      <label>BPM:</label>
      <input class="input" id="bpm" type="number" value="72">
      <label>Beats per cycle (taal):</label>
      <input class="input" id="beats" type="number" value="16">
      <button class="btn" onclick="startMet()">Start</button>
      <button class="btn" onclick="stopMet()">Stop</button>
    </div>
    <div class="card">
      <h3>Tuner (Beta)</h3>
      <p>Shows approximate frequency from the mic.</p>
      <button class="btn" onclick="startTuner()">Start</button>
      <div id="tunerOut" class="badge">— Hz</div>
      <small class="muted">Microphone permission required.</small>
    </div>
  </div>
</div>
<script>
let ac, osc1, osc2, osc3, metInt;
function startDrone(){
  ac = ac || new (window.AudioContext||window.webkitAudioContext)();
  stopDrone();
  let base = parseFloat(document.getElementById('baseHz').value||261.63);
  osc1 = ac.createOscillator(); osc1.type='sine'; osc1.frequency.value = base;
  osc2 = ac.createOscillator(); osc2.type='sine'; osc2.frequency.value = base*1.5; // Pa
  osc3 = ac.createOscillator(); osc3.type='sine'; osc3.frequency.value = base*2.0; // Sa upper
  const g = ac.createGain(); g.gain.value = 0.04;
  osc1.connect(g); osc2.connect(g); osc3.connect(g); g.connect(ac.destination);
  osc1.start(); osc2.start(); osc3.start();
}
function stopDrone(){ try{osc1.stop();osc2.stop();osc3.stop();}catch(e){} }
function startMet(){
  stopMet();
  let bpm = parseFloat(document.getElementById('bpm').value||72);
  let beats = parseInt(document.getElementById('beats').value||16);
  let i=0;
  metInt = setInterval(()=>{
    const click = new AudioContext();
    const o = click.createOscillator(); const g = click.createGain();
    o.type='square'; o.frequency.value = (i%beats===0)?2000:1100;
    g.gain.value=0.1; o.connect(g); g.connect(click.destination); o.start();
    setTimeout(()=>{o.stop(); click.close();}, 60);
    i++;
  }, (60000/bpm));
}
function stopMet(){ if (metInt) clearInterval(metInt); metInt=null; }
async function startTuner(){
  const out = document.getElementById('tunerOut');
  const stream = await navigator.mediaDevices.getUserMedia({audio:true});
  const ctx = new (window.AudioContext||window.webkitAudioContext)();
  const src = ctx.createMediaStreamSource(stream);
  const analyser = ctx.createAnalyser();
  analyser.fftSize = 2048;
  src.connect(analyser);
  const buf = new Float32Array(analyser.fftSize);
  function autoCorrelate(buf, sampleRate){
    let SIZE = buf.length; let rms=0;
    for(let i=0;i<SIZE;i++){let val=buf[i]; rms+=val*val;}
    rms=Math.sqrt(rms/SIZE); if(rms<0.01) return -1;
    let r1=0,r2=SIZE-1,thres=0.2;
    for(let i=0;i<SIZE/2;i++) if(Math.abs(buf[i])<thres){r1=i;break;}
    for(let i=1;i<SIZE/2;i++) if(Math.abs(buf[SIZE-i])<thres){r2=SIZE-i;break;}
    buf = buf.slice(r1,r2); SIZE = buf.length;
    let c = new Array(SIZE).fill(0);
    for(let i=0;i<SIZE;i++) for(let j=0;j<SIZE-i;j++) c[i]+=buf[j]*buf[j+i];
    let d=0; while(d<SIZE-1 && c[d]>c[d+1]) d++;
    let maxval=-1, maxpos=-1;
    for(let i=d;i<SIZE;i++) if(c[i]>maxval){maxval=c[i];maxpos=i;}
    let T0=maxpos; return sampleRate/T0;
  }
  function loop(){
    analyser.getFloatTimeDomainData(buf);
    let freq = autoCorrelate(buf, ctx.sampleRate);
    if (freq>0 && freq < 2000) out.textContent = freq.toFixed(1)+' Hz';
    requestAnimationFrame(loop);
  }
  loop();
}
</script>
<?php include __DIR__.'/_footer.php'; ?>
