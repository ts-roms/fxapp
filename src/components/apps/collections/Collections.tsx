import React, { useState } from 'react';
import { CollectionsTable } from '@app/components/tables/Collections/CollectionsTable';
import CollectionModal from '@app/shared/Modal/CollectionModal';
import { useTranslation } from 'react-i18next';
import * as S from './Collections.styles';
import { DownloadOutlined, PlusOutlined } from '@ant-design/icons';
import { Button } from '@app/components/common/buttons/Button/Button';

export const Collections: React.FC = () => {
  const { t } = useTranslation();
  const [open, setOpen] = useState(false);
  return (
    <S.CollectionWrapper>
      <CollectionModal open={open} setOpen={setOpen} />
      <S.Card
        id="collections-table"
        title={t('tables.title', { name: 'Payments' })}
        padding="1.25rem 1.25rem 0"
        extra={
          <S.ActionWrapper>
            <Button
              type="ghost"
              icon={<DownloadOutlined />}
              style={{
                marginRight: 10,
              }}
            >
              Bulk Payment
            </Button>
            <Button
              type="ghost"
              icon={<PlusOutlined />}
              onClick={() => setOpen((open) => !open)}
            >
              {t('actions.new', { name: 'Payment' })}
            </Button>
          </S.ActionWrapper>
        }
      >
        <CollectionsTable />
      </S.Card>
    </S.CollectionWrapper>
  );
};
