#Il server deve leggere il nome del file e lanciare lo script mettendolo come argomento
audioname=$1
../sox-14.4.2/src/sox ./audio/$1 ./audio/$1.wav

echo $audioname
echo $1 ./audio/$1.wav > ./data/input.scp #scrive nel file di input per kaldi il file che deve decodificare

featurename=$audioname"_features"
deltaname=$audioname"_deltas"	
wordsname=$audioname"_words.txt"
textname=$audioname"_text.txt"

 ../kaldi-master/src/featbin/compute-mfcc-feats  scp,t:./data/input.scp ark,t:./data/scrap/$featurename

 ../kaldi-master/src/featbin/add-deltas ark:./data/scrap/$featurename ark,t:./data/scrap/$deltaname

 ../kaldi-master/src/gmmbin/gmm-decode-faster --acoustic-scale=0.07 ./data/model ./data/HCLG.fst ark,t:./data/scrap/$deltaname ark,t:./data/scrap/$wordsname

 ./ids-to-text ark,t:./data/scrap/$wordsname ./data/words-symb-table.txt ./data/texts/$textname

