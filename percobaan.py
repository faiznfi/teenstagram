import csv
# from gensim import corpora,models 
# import gensim
# from sklearn.decomposition import LatentDirichletAllocation as LDA
from nltk.tokenize import RegexpTokenizer
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
import sys
# create stemmer
factory = StemmerFactory()
stemmer = factory.create_stemmer()
with open('data/bikin_stopword1.txt') as f:
    content = f.readlines()
# you may also want to .txt'
content = [x.strip() for x in content]

# create English stop words list
indo_stop = content
tokenizer = RegexpTokenizer(r'\w+')
i=0
text = sys.argv[1]
hasil=[]

def pre_new(doc):
    one = doc.split(' ')
    two = tokenizer.tokenize((text))
    return two
    belong = loading[(pre_new(text))]
    print(belong)

#         print(tokenizer.tokenize(hasil))
#         stopped_tokens = [i for i in asli if not i in indo_stop]
#         print(stopped_tokens)
#         forename = hasil
# dictionary = corpora.Dictionary(hasil)
    
# # convert tokenized documents into a document-term matrix
# corpus = [dictionary.doc2bow(text) for text in hasil]
# ldamodel = gensim.models.ldamodel.LdaModel(corpus, num_topics=2, id2word = dictionary, passes=20)
# tampil=ldamodel.print_topics(num_topics=5, num_words=2)
# print(tampil)

# lda = LDA(n_topics=10)
# lda.fit(ldamodel.print_topics(num_topics=5, num_words=2))
# training_features = lda.transform(training_data)
# testing_features = lda.transform(testing_data)
# print(lda)

# with open('data/3.data_training_no_stem.csv', 'w',newline='') as tulisFile:
#     tulisFileWriter = csv.writer(tulisFile)
#     for row in hasil:
#         tulisFileWriter.writerow([row])

#     tulisFile.close()