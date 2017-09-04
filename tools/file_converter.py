"""tras doc/ppt to pdf"""
import os
import glob
import time
import pythoncom
import win32com.client as client
from timeout import timeout, Timeout

WORK_FILE_PATH = 'E:\\Seafile\\ExBaseFiles\\content_files'
# WORK_FILE_PATH = 'g:\\test'


def chk_pdf(pdf_file):
    """chk_pdf"""
    chk_file = open(pdf_file, 'r', encoding='utf-8', errors='ignore')
    chk_text = chk_file.read(32)
    chk_file.close()
    if chk_text.find('E-SafeNet') >= 0:
        os.system('233 "%s"'%pdf_file)


@timeout(300)
def word2pdf(word_file, pdf_file):
    """convert word to pdf"""
    pythoncom.CoInitialize()
    word = client.Dispatch('Word.Application')
    doc = word.Documents.Open(word_file, ReadOnly=1)
    doc.SaveAs(pdf_file, 17)
    doc.Close()
    word.Quit()
    os.system('233 "%s"'%pdf_file)
    time.sleep(1)
    chk_pdf(pdf_file)


@timeout(300)
def ppt2pdf(ppt_file, pdf_file):
    """convert word to pdf"""
    pythoncom.CoInitialize()
    ppt = client.Dispatch('PowerPoint.application')
    doc = ppt.Presentations.Open(ppt_file, ReadOnly=1, Untitled=0, WithWindow=0)
    doc.SaveAs(pdf_file, 32)
    doc.Close()
    ppt.Quit()
    os.system('233 "%s"'%pdf_file)
    time.sleep(1)
    chk_pdf(pdf_file)


def file_scan():
    """file_scan"""
    files = glob.glob(os.path.join(WORK_FILE_PATH, '*.doc'))\
                + glob.glob(os.path.join(WORK_FILE_PATH, '*.docx'))\
                + glob.glob(os.path.join(WORK_FILE_PATH, '*.ppt'))\
                + glob.glob(os.path.join(WORK_FILE_PATH, '*.pptx'))
    for file in files:
        pdf_file = '.'.join(file.split('.')[:-1]) + '.pdf'
        if os.path.isfile(pdf_file):
            continue
        print('convert ' + file)
        if file.split('.')[-1] in ['doc', 'docx']:
            try:
                word2pdf(file, pdf_file)
            except Timeout:
                if os.path.isfile(pdf_file):
                    os.remove(pdf_file)
                print('doc convert timeout')
            except Exception:
                print('doc convert error')
                if os.path.isfile(pdf_file):
                    os.remove(pdf_file)

        elif file.split('.')[-1] in ['ppt', 'pptx']:
            try:
                ppt2pdf(file, pdf_file)
            except Timeout:
                if os.path.isfile(pdf_file):
                    os.remove(pdf_file)
                print('ppt convert timeout')
            except Exception:
                print('ppt convert error')
                if os.path.isfile(pdf_file):
                    os.remove(pdf_file)


if __name__ == '__main__':
    while True:
        file_scan()
        time.sleep(10)
