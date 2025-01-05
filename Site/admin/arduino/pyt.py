import psycopg2
import serial
import time

# Função para enviar comando para o Arduino
def send_command_to_arduino(led_id, status, ser):
    command = str(led_id) + str(status).capitalize()  # Altere para maiúscula
    ser.write(command.encode())
    print(command)

try:
    # Configurações da base de dados
    dbname = "<your_dbname>"
    user = "<your_user>"
    password = "<your_password>"
    host = "<your_host>"
    port = "<your_port>"

    # Conexão à base de dados
    conn = psycopg2.connect(dbname=dbname, user=user, password=password, host=host, port=port)
    cursor = conn.cursor()

    # Conectar à porta serial do Arduino
    serial_port = 'COM5' 
    baud_rate = 9600

    # Estabelecer conexão com o Arduino
    ser = serial.Serial(serial_port, baud_rate)
    print("Conexão com Arduino estabelecida.")
    # Enviar uma string simples para o Arduino
    ser.write("Teste de comunicação\n".encode('utf-8'))
    print("String de teste enviada para o Arduino.")

    while True:  # Loop infinito
        # Executar a consulta
        cursor.execute("SELECT id_luz, status FROM luzes ORDER BY id_luz ASC;")
        rows = cursor.fetchall()

        # Enviar comandos para o Arduino com base nos resultados da consulta
        for row in rows:
            time.sleep(1.1)
            id_luz, status = row
            send_command_to_arduino(id_luz, status, ser)

except serial.SerialException as e:
    print("Erro ao conectar à porta serial:", e)

except psycopg2.Error as error:
    print("Erro ao conectar à base de dados:", error)

finally:
    # Fechar conexões
    if 'cursor' in locals() and cursor is not None:
        cursor.close()
    if 'conn' in locals() and conn is not None:
        conn.close()
    if 'ser' in locals() and ser.is_open:
        ser.close()
